var map = L.map("partnerMap").setView([0, 0], 2);
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

// Add markers for partner institutions
var partners = [
  { name: "University XYZ", lat: 40.7128, lon: -74.006 },
  { name: "ABC University", lat: 51.5074, lon: -0.1278 },
  { name: "DEF Business School", lat: 35.6762, lon: 139.6503 },
];

partners.forEach(function (partner) {
  L.marker([partner.lat, partner.lon]).addTo(map).bindPopup(partner.name);
});
