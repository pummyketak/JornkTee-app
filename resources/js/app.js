import './bootstrap';
// import './css/app.css';  // นำเข้าไฟล์ CSS
import 'bootstrap';  // ✅ นำเข้า Bootstrap JavaScript
import 'bootstrap/dist/js/bootstrap.bundle.min';
import '../css/app.scss';  // นำเข้า SCSS แทน CSS


import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
