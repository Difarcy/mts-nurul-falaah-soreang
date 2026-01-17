<?php

namespace App\Domain\Chatbot\Services;

use App\Models\InfoText;
use App\Models\Post;
use App\Models\SpmbSetting;
use App\Models\SchoolProfile;
use App\Models\StudentAchievement;
use App\Models\Announcement;
use App\Models\Schedule;
use App\Models\SpmbFaq;
use App\Models\SpmbRequirement;
use App\Models\SpmbTimeline;
use App\Models\VisualIdentity;
use App\Models\Banner;
use App\Models\Contact;
use Illuminate\Support\Carbon;

class ChatbotContextService
{
    /**
     * Membangun konteks prompt untuk AI berdasarkan data sekolah terkini yang tampil di website.
     * Terhubung langsung ke seluruh model/program utama.
     */
    public function getSchoolContext(?string $currentPageUrl = null, ?string $currentPageTitle = null): string
    {
        // 1. Ambil Identitas & Branding Website
        $branding = VisualIdentity::first(['tagline', 'judul', 'deskripsi']);

        // 2. Ambil Profil & Pimpinan
        $profile = SchoolProfile::first([
            'nama_sekolah',
            'kepala_sekolah_nama',
            'visi',
            'misi',
            'tujuan',
            'sejarah',
            'deskripsi_sekolah',
            'kepala_sekolah_sambutan'
        ]);

        // 3. Ambil Data Berita & Artikel Terkini (Masing-masing 2 agar tidak tenggelam)
        $latestNews = Post::published()
            ->where('type', '=', 'berita')
            ->latest('published_at')
            ->take(2)
            ->get(['title', 'published_at', 'type', 'view_count']);

        $latestArticles = Post::published()
            ->where('type', '=', 'artikel')
            ->latest('published_at')
            ->take(2)
            ->get(['title', 'published_at', 'type', 'view_count']);

        $announcements = Announcement::where('status', '=', 'publish')
            ->latest()
            ->take(2)
            ->get(['judul', 'isi', 'tanggal']);

        $agendas = Schedule::where('status', '=', 'publish')
            ->where('tanggal_mulai', '>=', now()->toDateString())
            ->orderBy('tanggal_mulai', 'asc')
            ->take(3)
            ->get(['judul', 'tanggal_mulai', 'lokasi']);

        $achievements = StudentAchievement::where('is_active', '=', true)
            ->latest()
            ->take(3)
            ->get(['judul', 'nama_siswa', 'tingkat_prestasi', 'jenis_prestasi', 'deskripsi']);

        // 4. Ambil Data SPMB (Pendaftaran)
        $spmb = SpmbSetting::first(['*']);
        $spmbRequirements = SpmbRequirement::orderBy('urutan')->pluck('content')->toArray();
        $spmbTimeline = SpmbTimeline::orderBy('urutan')->get();

        // 5. Ambil Video Kegiatan
        $latestVideos = \App\Models\ActivityVideo::where('is_active', '=', true)
            ->latest()
            ->take(3)
            ->get(['judul', 'youtube_url']);

        // 6. Ambil Banner (Promo & Pengumuman Utama)
        $banners = Banner::where('is_active', '=', true)
            ->orderBy('urutan')
            ->get(['judul', 'tagline', 'deskripsi']);

        // 7. Ambil Berita Populer (Trending) & Unggulan
        $trendingNews = Post::published()
            ->withCount('comments')
            ->orderBy('view_count', 'desc')
            ->take(3)
            ->get(['title', 'view_count', 'slug', 'type']);

        $featuredPosts = Post::published()
            ->where('is_featured', '=', true)
            ->take(2)
            ->get(['title', 'type']);

        // 8. Ambil Foto Kegiatan Terbaru
        $latestPhotos = \App\Models\ActivityPhoto::where('is_active', '=', true)
            ->latest()
            ->take(3)
            ->pluck('judul')
            ->toArray();

        // 9. Statistik Global (Live Counts)
        $stats = [
            'total_prestasi' => StudentAchievement::where('is_active', '=', true)->count(),
            'total_berita' => Post::published()->count(),
            'total_foto' => \App\Models\ActivityPhoto::where('is_active', '=', true)->count(),
            'total_video' => \App\Models\ActivityVideo::where('is_active', '=', true)->count(),
        ];

        // 10. Ambil Tag Populer
        $allTags = Post::published()->pluck('tags');
        $topTags = [];
        if ($allTags) {
            $flattened = [];
            foreach ($allTags as $tags) {
                if (is_array($tags))
                    $flattened = array_merge($flattened, $tags);
            }
            $tagsCount = array_count_values($flattened);
            arsort($tagsCount);
            $topTags = array_keys(array_slice($tagsCount, 0, 5));
        }

        // 11. Ambil Kontak & Peta
        $contacts = Contact::where('is_active', '=', true)->get(['label', 'nilai']);
        $site = [
            'address' => InfoText::where('key', '=', 'site_address')->value('value'),
            'phone' => InfoText::where('key', '=', 'site_phone')->value('value'),
            'email' => InfoText::where('key', '=', 'site_email')->value('value'),
            'maps' => InfoText::where('key', '=', 'site_map_coordinates')->value('value'),
            'facebook' => InfoText::where('key', '=', 'top_bar_facebook_url')->value('value'),
            'instagram' => InfoText::where('key', '=', 'top_bar_instagram_url')->value('value'),
            'youtube' => InfoText::where('key', '=', 'top_bar_youtube_url')->value('value'),
            'tiktok' => InfoText::where('key', '=', 'top_bar_tiktok_url')->value('value'),
        ];

        // --- MULAI MEMBANGUN KONTEKS ---
        $now = now()->isoFormat('dddd, D MMMM Y [jam] HH:mm');
        $context = "Anda adalah Nafa, asisten virtual resmi MTs Nurul Falaah Soreang.\n";
        $context .= "WAKTU SISTEM SAAT INI: {$now} WIB\n\n";

        if ($currentPageUrl || $currentPageTitle) {
            $context .= "KONTEKS HALAMAN SAAT INI: " . ($currentPageTitle ?? 'Web') . " (" . ($currentPageUrl ?? '') . ")\n\n";

            // --- DETEKSI KONTEN DETAIL (SMART PAGE READER) ---
            $path = parse_url($currentPageUrl, PHP_URL_PATH);
            if ($path) {
                $path = trim($path, '/');
                $segments = explode('/', $path);

                // Case 1: Post Detail (/informasi/{type}/{slug})
                if (str_contains($path, 'informasi/') && count($segments) >= 3) {
                    $slug = end($segments);
                    $post = Post::where('slug', '=', $slug)->first(['title', 'body', 'type']);
                    if ($post) {
                        $context .= ">>> USER SEDANG MEMBACA " . strtoupper($post->type) . " <<<\n";
                        $context .= "Judul Halaman: {$post->title}\n";
                        $context .= "Isi Lengkap Konten: " . \Illuminate\Support\Str::limit(strip_tags($post->body), 4000) . "\n";
                        $context .= "(Nafa, gunakan isi di atas untuk menjawab pertanyaan detail user jika mereka bertanya tentang artikel ini).\n\n";
                    }
                }
                // Case 2: Pengumuman Detail (/pengumuman/{id})
                elseif (str_contains($path, 'pengumuman/') && count($segments) >= 2) {
                    $id = end($segments);
                    if (is_numeric($id)) {
                        $ann = Announcement::find($id, ['judul', 'isi']);
                        if ($ann) {
                            $context .= ">>> USER SEDANG MEMBACA PENGUMUMAN <<<\n";
                            $context .= "Judul: {$ann->judul}\n";
                            $context .= "Isi Lengkap: " . \Illuminate\Support\Str::limit(strip_tags($ann->isi), 4000) . "\n\n";
                        }
                    }
                }
                // Case 3: Agenda Detail (/informasi/agenda/{id})
                elseif (str_contains($path, 'agenda/') && count($segments) >= 2) {
                    $id = end($segments);
                    if (is_numeric($id)) {
                        $sch = Schedule::find($id, ['judul', 'deskripsi', 'lokasi', 'tanggal_mulai']);
                        if ($sch) {
                            $context .= ">>> USER SEDANG MEMBACA AGENDA <<<\n";
                            $context .= "Agenda: {$sch->judul}\n";
                            $context .= "Lokasi: {$sch->lokasi}\n";
                            $context .= "Isi Lengkap: " . \Illuminate\Support\Str::limit(strip_tags($sch->deskripsi), 4000) . "\n\n";
                        }
                    }
                }
            }
        }

        // --- SECTION A: DATA STATIS (IDENTITAS PERMANEN) ---
        $context .= "=== [STATUS PERMANEN & IDENTITAS SEKOLAH] ===\n";
        $context .= "- Nama Resmi: " . ($profile->nama_sekolah ?? 'MTs Nurul Falaah Soreang') . "\n";
        $context .= "- NPSN: 20278189 (Akreditasi B)\n";
        if ($profile && $profile->deskripsi_sekolah) {
            $context .= "- Tentang Sekolah: " . strip_tags($profile->deskripsi_sekolah) . "\n";
        }
        if ($profile && $profile->sejarah) {
            $context .= "- Sejarah Singkat: " . \Illuminate\Support\Str::limit(strip_tags($profile->sejarah), 500) . "\n";
        }
        $context .= "- Yayasan: Yayasan Nurul Falaah Soreang\n";
        $context .= "- Kepala Madrasah: " . ($profile->kepala_sekolah_nama ?? '-') . "\n";
        $context .= "- Alamat: " . ($site['address'] ?? 'Soreang, Bandung') . "\n";
        $context .= "- Statistik Aktivitas Website: [{$stats['total_berita']} Konten Terbit], [{$stats['total_prestasi']} Prestasi Siswa], [{$stats['total_foto']} Galeri Foto], [{$stats['total_video']} Video Kegiatan].\n";
        if (!empty($topTags))
            $context .= "- Topik Sering Dibahas: " . implode(', ', $topTags) . ".\n";
        $context .= "- Fasilitas: Masjid, Lab Komputer, Perpustakaan, Aula, Lapangan, Kantin Sehat.\n";
        $context .= "- Ekstrakurikuler: Pramuka, OSIS, Kaligrafi, Seni Islami, Olahraga.\n";
        $context .= "- Keunggulan: Akhlakul Karimah, Tahfidz Al-Qur'an, dan Teknologi Informasi.\n\n";

        // --- SECTION B: DATA DINAMIS (SELALU BERUBAH/REAL-TIME) ---
        $context .= "=== [DATA DINAMIS & UPDATE TERKINI] ===\n";
        $context .= "Info di bawah ini ditarik langsung dari database kami saat ini:\n\n";

        // Berita & Artikel
        $context .= ">> KABAR TERBARU (BERITA):\n";
        if ($latestNews->isEmpty()) {
            $context .= "Belum ada berita kegiatan terbaru.\n";
        } else {
            foreach ($latestNews as $news) {
                $date = $news->published_at ? $news->published_at->isoFormat('D MMMM Y') : '-';
                $context .= "- [BERITA] [{$date}] {$news->title} (Dilihat {$news->view_count} kali)\n";
            }
        }

        $context .= "\n>> ARTIKEL & EDUKASI TERBARU:\n";
        if ($latestArticles->isEmpty()) {
            $context .= "Belum ada artikel edukasi terbaru.\n";
        } else {
            foreach ($latestArticles as $art) {
                $date = $art->published_at ? $art->published_at->isoFormat('D MMMM Y') : '-';
                $context .= "- [ARTIKEL] [{$date}] {$art->title} (Dilihat {$art->view_count} kali)\n";
            }
        }

        if (!$trendingNews->isEmpty()) {
            $context .= "\n>> TRENDING (PALING BANYAK DILIHAT):\n";
            foreach ($trendingNews as $trend) {
                $type = strtoupper($trend->type === 'berita' ? 'BERITA' : 'ARTIKEL');
                $commentText = $trend->comments_count > 0 ? " & {$trend->comments_count} diskusi" : "";
                $context .= "- [{$type}] {$trend->title} ({$trend->view_count} views{$commentText})\n";
            }
        }
        if (!$featuredPosts->isEmpty()) {
            $context .= ">> INFO UNGGULAN (ADMIN PICKS):\n";
            foreach ($featuredPosts as $fp) {
                $type = strtoupper($fp->type === 'berita' ? 'berita' : 'artikel');
                $context .= "- [{$type}] {$fp->title}\n";
            }
        }
        $context .= "\n";

        // Banner Promosi (Dinamis)
        if (!$banners->isEmpty()) {
            $context .= ">> PROMO & HEADLINE WEBSITE:\n";
            foreach ($banners as $b) {
                $tag = $b->tagline ? " ({$b->tagline})" : "";
                $context .= "- {$b->judul}{$tag}: {$b->deskripsi}\n";
            }
            $context .= "\n";
        }

        // Pengumuman & Agenda
        $context .= ">> PENGUMUMAN & AGENDA MENDATANG:\n";
        if ($announcements->isEmpty() && $agendas->isEmpty()) {
            $context .= "Tidak ada pengumuman atau agenda mendesak.\n";
        } else {
            foreach ($announcements as $info) {
                $dateAnn = $info->tanggal ? $info->tanggal->isoFormat('D MMMM Y') : '-';
                $context .= "[PENGUMUMAN] [{$dateAnn}] {$info->judul}\n";
            }
            foreach ($agendas as $agenda) {
                $date = $agenda->tanggal_mulai ? Carbon::parse($agenda->tanggal_mulai)->isoFormat('D MMMM Y') : '-';
                $context .= "[AGENDA] {$date}: {$agenda->judul}\n";
            }
        }
        $context .= "\n";

        // Status SPMB (Sangat Dinamis)
        if ($spmb) {
            $status = ($spmb->registration_status === 'open') ? 'SEDANG DIBUKA' : 'SEDANG DITUTUP';
            $biaya = ($spmb->registration_fee <= 0) ? 'Gratis' : 'Rp ' . number_format($spmb->registration_fee, 0, ',', '.');
            $context .= ">> STATUS PENDAFTARAN (SPMB {$spmb->academic_year}):\n";
            $context .= "- Status Saat Ini: {$status}\n";
            $context .= "- Biaya Pendaftaran: {$biaya}\n";
            if (!$spmbTimeline->isEmpty()) {
                $context .= "- Alur Terdekat: ";
                foreach ($spmbTimeline->take(2) as $t) {
                    $context .= "{$t->activity} (" . ($t->start_date ? Carbon::parse($t->start_date)->format('d/m') : '') . "), ";
                }
                $context .= "\n";
            }
            $context .= "\n";
        }

        // Dokumentasi (Dinamis)
        if (!empty($latestPhotos)) {
            $context .= ">> ALBUM FOTO TERBARU:\n";
            $context .= "- " . implode(', ', $latestPhotos) . "\n";
            $context .= "\n";
        }

        if (!$latestVideos->isEmpty()) {
            $context .= ">> VIDEO KEGIATAN TERBARU:\n";
            foreach ($latestVideos as $video) {
                $context .= "- {$video->judul} (Video: {$video->youtube_url})\n";
            }
            $context .= "\n";
        }

        // --- SECTION C: KNOWLEDGE BASE (VISI, MISI, SAMBUTAN, FAQ) ---
        $context .= "=== [PUSAT PENGETAHUAN / FAQ] ===\n";

        if ($profile && $profile->kepala_sekolah_sambutan) {
            $context .= ">> PESAN KEPALA MADRASAH: " . \Illuminate\Support\Str::limit(strip_tags($profile->kepala_sekolah_sambutan), 500) . "\n";
        }

        $vision = InfoText::where('key', '=', 'site_vision')->value('value');
        if ($vision || ($profile && $profile->visi)) {
            $context .= ">> VISI: " . strip_tags($vision ?? $profile->visi) . "\n";
            if ($profile && $profile->misi)
                $context .= ">> MISI: " . strip_tags($profile->misi) . "\n";
            if ($profile && $profile->tujuan)
                $context .= ">> TUJUAN: " . strip_tags($profile->tujuan) . "\n";
        }

        // Detail Prestasi (Dinamis)
        if (!$achievements->isEmpty()) {
            $context .= ">> DETAIL PRESTASI SISWA:\n";
            foreach ($achievements as $ach) {
                $descAch = \Illuminate\Support\Str::limit(strip_tags($ach->deskripsi), 150);
                $context .= "- {$ach->judul} ({$ach->nama_siswa}): {$descAch}\n";
            }
        }

        $faqs = SpmbFaq::orderBy('urutan')->take(3)->get(['question', 'answer']);
        if (!$faqs->isEmpty()) {
            foreach ($faqs as $faq) {
                $context .= "T: {$faq->question} | J: " . strip_tags($faq->answer) . "\n";
            }
        }
        $context .= "\n";

        // Kontak & Sosial Media
        if ($contacts && !$contacts->isEmpty() || $site['facebook'] || $site['instagram'] || $site['maps']) {
            $context .= ">> HUBUNGI KAMI & MEDIA SOSIAL:\n";
            foreach ($contacts as $c)
                $context .= "- {$c->label}: {$c->nilai}\n";

            if ($site['facebook'])
                $context .= "- Facebook: {$site['facebook']}\n";
            if ($site['instagram'])
                $context .= "- Instagram: {$site['instagram']}\n";
            if ($site['youtube'])
                $context .= "- YouTube: {$site['youtube']}\n";
            if ($site['tiktok'])
                $context .= "- TikTok: {$site['tiktok']}\n";
            if ($site['maps'])
                $context .= "- Lokasi/Peta (Google Maps): https://www.google.com/maps/search/?api=1&query=" . urlencode($site['maps']) . "\n";
            $context .= "\n";
        }

        $context .= "PANDUAN OPERASIONAL NAFA:\n";
        $context .= "1. VALIDASI DATA: Berikan jawaban berdasarkan data SISTEM jika tersedia. Jika user tanya hal teknis yang tidak ada di atas (misal: 'berapa ukuran baju olahraga'), katakan jujur bahwa informasi tersebut tidak tercantum di sistem kami dan arahkan untuk bertanya via WhatsApp.\n";
        $context .= "2. KLASIFIKASI INFO: Bedakan secara TEGAS antara 'BERITA' (kejadian/news) dan 'ARTIKEL' (tulisan edukasi/opini). Jika user bertanya tentang kabar terbaru, cari yang berlabel [BERITA]. Jika user bertanya tentang tips/pengetahuan, cari yang berlabel [ARTIKEL].\n";
        $context .= "3. REKOMENDASI PROAKTIF: Jika user bertanya tentang kabar terbaru, berikan info dari 'Trending' atau 'Info Unggulan' untuk menunjukkan betapa aktifnya sekolah kami.\n";
        $context .= "4. KONTAK FORM: Selalu ingatkan bahwa pengunjung bisa mengisi FORMULIR KONTAK di halaman ini jika ingin jawaban tertulis resmi dari admin sekolah.\n";
        $context .= "5. PERSONA & GAYA BAHASA: Profesional, ramah, dan sangat membantu. Gunakan bahasa Indonesia yang baik tapi tetap terasa dekat.\n";
        $context .= "6. LIMITASI: Maksimal 3 kalimat per jawaban. Fokus pada inti solusi.\n";
        $context .= "7. PENUTUP: Selalu akhiri dengan satu emoji positif (😊/🚀/✨).\n";

        return $context;
    }
}
