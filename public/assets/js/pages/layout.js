// Cek mode dari sessionStorage, jika null (belum disetel), gunakan "dark" sebagai default
let layoutMode = sessionStorage.getItem("data-layout-mode") || "dark";

// Tetapkan atribut data-bs-theme berdasarkan nilai layoutMode
if (layoutMode === "light") {
    document.documentElement.setAttribute("data-bs-theme", "light");
} else {
    document.documentElement.setAttribute("data-bs-theme", "dark");
}

// Simpan default mode ke sessionStorage jika belum disetel
if (!sessionStorage.getItem("data-layout-mode")) {
    sessionStorage.setItem("data-layout-mode", "dark");
}
