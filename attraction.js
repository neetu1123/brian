// Attraction slider JS
const attractions = [
    {
        img: "images.jpeg",
        caption: "UNIQUE BEACH TOWNS"
    },
    {
        img: "images.jpeg",
        caption: "WHITE SAND BEACHES"
    },
    {
        img: "images.jpeg",
        caption: "LOCAL EATERIES"
    }
];

let attractionIndex = 0;

function renderAttractions() {
    const row = document.getElementById('attraction-cards-row');
    row.innerHTML = '';
    for (let i = 0; i < 3; i++) {
        const idx = (attractionIndex + i) % attractions.length;
        const card = document.createElement('div');
        card.className = 'col-lg-4 col-md-6 attraction-card-col';
        card.innerHTML = `
      <div class="attraction-card card h-100 border-0">
        <img src="${attractions[idx].img}" class="card-img-top attraction-img" alt="${attractions[idx].caption}">
        <div class="card-img-overlay d-flex align-items-end justify-content-center p-0">
          <div class="attraction-caption w-100 text-center">${attractions[idx].caption}</div>
        </div>
      </div>
    `;
        row.appendChild(card);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    renderAttractions();
    document.getElementById('attraction-prev').addEventListener('click', function () {
        attractionIndex = (attractionIndex - 1 + attractions.length) % attractions.length;
        renderAttractions();
    });
    document.getElementById('attraction-next').addEventListener('click', function () {
        attractionIndex = (attractionIndex + 1) % attractions.length;
        renderAttractions();
    });
});
