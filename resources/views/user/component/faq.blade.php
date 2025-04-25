<section id="sub-judul-3">
    <div class="container-lima">
        <div class="sub-judul-3">
            <h3>Alur Magang</h3>
        </div>
        <!-- Timeline Karir -->
            <div class="relative max-w-4xl mx-auto">
                <!-- Garis Tengah -->
                <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-blue-600 z-0"></div>
            
                <!-- Container Items -->
                <div id="timeline-items" class="flex flex-col gap-3 relative z-10">
                    <!-- Item 1 -->
                    <div class="flex justify-start relative">
                    <div class="w-1/2 pr-8 text-right">
                        <div class="bg-white shadow-md p-5 rounded-xl dark:bg-gray-800" data-aos="fade-right">
                        <h3 class="text-lg font-bold">2025 - Junior DevOps Engineer</h3>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-200">Maret - April</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Mengelola server SMKN 4 Jember dengan Proxmox VE dan melakukan konfigurasi web service dengan docker.</p>
                        </div>
                    </div>
                    </div>
            
                    <!-- Item 2 -->
                    <div class="flex justify-end relative">
                    <div class="w-1/2 pl-8 text-left">
                        <div class="bg-white shadow-md p-5 rounded-xl dark:bg-gray-800" data-aos="fade-left">
                        <h3 class="text-lg font-bold">2024 - Data Analyst</h3>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-200">September - December</p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Program MBKM kolaborasi Datains dan BRIN yang mengembangkan platform Smart Tourism berbasis Artificial Intelligence untuk destinasi pariwisata super prioritas.</p>
                        </div>
                    </div>
                    </div>
                    
                    <!-- Item 3 -->
                    <div class="flex justify-start relative">
                        <div class="w-1/2 pr-8 text-right">
                        <div class="bg-white shadow-md p-5 rounded-xl dark:bg-gray-800" data-aos="fade-right">
                            <h3 class="text-lg font-bold">2021 - IT Support</h3>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-200">Januari - April</p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Kegiatan magang SMK di Taman Nasional Bali Barat. Melakukan instalasi, konfigurasi, serta troubleshoot masalah pada komputer dan aplikasi</p>
                        </div>
                        </div>
                    </div>

                </div>
            </div>    
        <!-- End Timeline Karir -->
        <script>
            // Script Titik Otomatis di Timeline Karir
            document.addEventListener("DOMContentLoaded", () => {
                const container = document.querySelector("#timeline-items");
                const items = container.querySelectorAll("div.flex");
                const line = document.querySelector("#timeline .relative");

                items.forEach((item, index) => {
                    const dot = document.createElement("div");
                    dot.className = `
                    absolute left-1/2 transform -translate-x-1/2
                    w-4 h-4 bg-white border-4 border-blue-600 rounded-full z-20
                    `;

                    const ping = document.createElement("div");
                    ping.className = `
                    absolute inset-0 rounded-full bg-blue-400 opacity-75
                    animate-ping-slow
                    `;

                    // Dapatkan posisi card
                    const topOffset = item.offsetTop + item.offsetHeight / 2;
                    dot.style.top = `${topOffset}px`;

                    line.appendChild(dot);
                    dot.appendChild(ping);
                });
            });
        </script>
    </div>
</section>