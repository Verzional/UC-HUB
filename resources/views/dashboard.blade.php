<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Student Dashboard
        </h2>
    </x-slot>

    <div class="py-10 bg-[#FFF6EE] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 space-y-8">

            {{-- ================= APPLICATION STATUS ================= --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Application Status</h3>

                <div class="space-y-4">

                    {{-- Applied --}}
                    <div class="flex justify-between items-start border rounded-xl p-4">
                        <div>
                            <h4 class="font-medium text-gray-800">
                                Frontend Developer Intern – PT ABC
                            </h4>
                            <p class="text-sm text-gray-500 mt-1">
                                Lamaran berhasil dikirim ke sistem, sedang dalam proses verifikasi oleh tim ICE.
                            </p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
                            Applied
                        </span>
                    </div>

                    {{-- Shortlisted --}}
                    <div class="flex justify-between items-start border rounded-xl p-4">
                        <div>
                            <h4 class="font-medium text-gray-800">
                                UI/UX Designer Intern – PT XYZ
                            </h4>
                            <p class="text-sm text-gray-500 mt-1">
                                Lamaran lolos verifikasi ICE dan telah diteruskan ke pihak perusahaan.
                            </p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                            Shortlisted
                        </span>
                    </div>

                    {{-- Accepted --}}
                    <div class="flex justify-between items-start border rounded-xl p-4">
                        <div>
                            <h4 class="font-medium text-gray-800">
                                Mobile Developer Intern – PT DEF
                            </h4>
                            <p class="text-sm text-gray-500 mt-1">
                                Selamat! Lamaran anda diterima oleh perusahaan. Cek email atau hubungi ICE untuk administrasi magang.
                            </p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                            Accepted
                        </span>
                    </div>

                    {{-- Rejected --}}
                    <div class="flex justify-between items-start border rounded-xl p-4">
                        <div>
                            <h4 class="font-medium text-gray-800">
                                Backend Developer Intern – PT GHI
                            </h4>
                            <p class="text-sm text-gray-500 mt-1">
                                Mohon maaf, lamaranmu belum disetujui oleh tim ICE atau perusahaan terkait.
                            </p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs bg-red-100 text-red-700">
                            Rejected
                        </span>
                    </div>

                </div>
            </div>

            {{-- ================= RECOMMENDATION INBOX ================= --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Recommendation Inbox</h3>

                <div class="space-y-4">

                    <div class="border rounded-xl p-4">
                        <p class="text-sm text-gray-700">
                            💡 <strong>ICE Recommendation</strong><br>
                            Hai, profil kamu cocok untuk lowongan baru di <strong>PT X</strong>. Cek sekarang!
                        </p>

                        <div class="mt-4 flex justify-end gap-3">
                            <button
                                class="px-5 py-2 rounded-full text-sm bg-orange-500 text-white hover:bg-orange-600">
                                Accept Opportunity
                            </button>
                        </div>
                    </div>

                    {{-- After Accept --}}
                    <div class="border rounded-xl p-4 bg-gray-50">
                        <p class="text-sm text-gray-600">
                            ✅ Kamu telah menerima rekomendasi lowongan ini.<br>
                            <span class="italic">Tunggu kabar dari ICE.</span>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
