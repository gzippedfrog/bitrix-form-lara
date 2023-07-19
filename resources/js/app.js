import './bootstrap';
import flatpickr from "flatpickr";

flatpickr("#birthdate", {
    altInput: true,
    altFormat: "d.m.Y",
    allowInput: true
});
