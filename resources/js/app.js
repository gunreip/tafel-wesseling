import "../css/app.css";
import { createIcons } from "lucide";

document.addEventListener("DOMContentLoaded", () => {
  // ersetzt <i data-lucide="search"></i> etc. durch SVGs
  createIcons();
});
