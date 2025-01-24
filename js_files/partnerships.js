// map script
// Add markers for countries
function initMapMarker() {
  const promises = countries.map(fetchCountryAndMakeMarker);

  Promise.all(promises);
}
async function fetchCountryAndMakeMarker(countryName) {
  return fetch(
    `https://nominatim.openstreetmap.org/search?country=${countryName}&format=json`
  )
    .then((response) => response.json())
    .then((data) => {
      if (data.length > 0) {
        const { lat, lon } = data[0];

        const name =
          countryName.trim().split("")[0].toUpperCase() +
          countryName.trim().slice(1);

        const countryCoords = {
          name,
          coords: [Number(lon), Number(lat)],
        };

        console.log(`${countryName} coordinates:`, countryCoords);

        countries.push(countryCoords);
        addMarker(countryCoords);
      } else {
        console.error("Country not found!");
      }
    })
    .catch((error) => console.error("Error fetching data:", error));
}

// Initialize the map
const map = new maplibregl.Map({
  container: "map", // Container ID
  style: "https://basemaps.cartocdn.com/gl/positron-gl-style/style.json", // Map style URL
  center: [78.9629, 22.3511148], // Center of the world [lng, lat]
  zoom: 0.1, // Fit the whole world
  interactive: true, // Disable interactions
});
// Disable zooming with mouse scroll or touchpad
map.scrollZoom.disable();
// Disable zooming via double click
map.doubleClickZoom.disable();
// Disable zooming using the keyboard (+/- keys)
map.keyboard.disable();

window.addEventListener("resize", (e) => {
  console.log(document.innerHight, document.innerHeight);

  map.resize();
});

map.on("load", () => {
  console.log("Map loaded successfully");

  map.setMaxBounds([
    [-175, -85], // Southwest corner
    [180, 85], // Northeast corner
  ]);
});

function addMarker(country) {
  // Create a DOM element for the marker
  const el = document.createElement("div");
  el.style.backgroundImage =
    "url('https://cdn-icons-png.flaticon.com/512/684/684908.png')";
  el.className = "marker";

  // Add a click event to the marker
  el.addEventListener("click", () => {
    window.open(
      `https://www.google.com/maps/search/jis+university+in+${country.name}`,
      "_blank"
    );
  });

  // Add the marker to the map
  new maplibregl.Marker(el).setLngLat(country.coords).addTo(map);

  // Add hover tooltip
  const popup = new maplibregl.Popup({
    closeButton: false,
    closeOnClick: false,
    offset: 25,
  }).setHTML(`<div class="tooltip">${country.name}</div>`);

  el.addEventListener("mouseenter", () =>
    popup.setLngLat(country.coords).addTo(map)
  );
  el.addEventListener("mouseleave", () => popup.remove());
}

map.on("error", (e) => {
  console.error("Map-libre error:", e.error);
});

map.on("resize", (e) => {
  console.log("Map resized");
});

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// success stories script
const cardContainer = document.querySelector(".card-container");

function initStories() {
  stories.forEach(renderStory);
  initSwiper();
}
function renderStory(story) {
  const html = `<div class="card swiper-slide animate-on-scroll">
              <div class="studentDetails">
                <img
                  src="${story.image}"
                  alt="${story.name}"
                />
                <p class="studentName">${story.name}</p>
              </div>
              <p class="story">${story.story}</p>
              <div class="educationDetails">
                <div class="stream">${story.stream}</div>
                <div class="universityImage">
                <img
                  src="${story.universityImage}"
                  alt="${story.university}"
                />
                </div>
              </div>
            </div>`;

  cardContainer.innerHTML += html;
}

function initSwiper() {
  const cardCount = document.querySelectorAll("#success-story .card").length;
  console.log(cardCount);

  // Initialize Swiper only if there are enough cards to swipe
  if (cardCount > 1) {
    new Swiper(".swiper", {
      slidesPerView: 1, // Default for mobile
      spaceBetween: 20,
      // loop: true,
      cursorGrab: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      grid: {
        rows: 1, // Default for mobile
        fill: "row", // Ensures cards fill rows first
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
          grid: {
            rows: 2, // Two rows on tablets
          },
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 3,
          grid: {
            rows: 2, // Two rows on desktops
          },
          spaceBetween: 20,
        },
      },
    });
  } else {
    // Add fallback for single card or no cards
    document.querySelector(".swiper").classList.add("no-swiper");
  }
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// form validation script
const form = document.querySelector("form");
const inputField = document.querySelectorAll(".input-field");
const formError = document.getElementById("form-error");

// method for call on error
function onError(field, message) {
  const parentField = field.parentElement;

  parentField.classList.add("error");
  parentField.classList.remove("success");
  const errorElement = parentField.querySelector(".error-message");
  errorElement.textContent = message;
}

// method for call on success
function onSuccess(field) {
  const parentField = field.parentElement;

  parentField.classList.remove("error");
  parentField.classList.add("success");
  formError.style.display = "none";
  const errorElement = parentField.querySelector(".error-message");
  errorElement.textContent = "";
}

// form validation
inputField.forEach((field) => {
  field.addEventListener("input", (e) => {
    const value = field.value.trim();
    const name = field.name.split("-").join(" ");

    if (value === "") {
      const message = `${name} is Required`;
      onError(field, message);
    } else if (field.type !== "email" && value.length < 3) {
      onError(field, `${name} must be at least 3 characters long`);
    } else {
      const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      if (field.type === "email" && !emailPattern.test(value)) {
        onError(field, `Email Is Invalid`);
      } else {
        onSuccess(field);
      }
    }
  });
});

// form submit to backend
form.addEventListener("submit", (e) => {
  e.preventDefault();

  const successFields = document.querySelectorAll(".success");
  console.log(inputField.length, successFields.length);

  if (successFields.length !== inputField.length) {
    formError.style.display = "block";
    formError.textContent = "Please fill in all required fields.";
    return;
  }

  formError.style.display = "none";
  const formData = new FormData(form);
  const data = Object.fromEntries(formData.entries());
  console.log(data);
  form.reset();
});

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// guideline script
const guidelineSummaries = document.querySelectorAll(".guideLineSummery");

guidelineSummaries.forEach((summary) => {
  const parent = summary.parentElement;
  const content = parent.querySelector(".guideLineContent");

  summary.addEventListener("click", () => {
    if (parent.classList.contains("open")) {
      // Closing the content
      content.style.height = "0";
      parent.classList.remove("open");
    } else {
      // Opening the content
      const contentHeight = content.scrollHeight + "px";
      parent.classList.add("open");
      content.style.height = contentHeight;
    }
  });
});

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// All render Data
const countries = ["USA", "India", "Germany", "France", "Canada"];
initMapMarker();
const stories = [
  {
    name: "Jane Smith",
    image: "https://publicassets.leverageedu.com/stories/kshitij.webp",
    story:
      "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est itaque cupiditate perferendis maxime, praesentium, id expedita, ipsam quasi eum ducimus nostrum et totam eos culpa ad voluptatum tenetur placeat consequuntur.",
    stream: "Web Developer",
    university: "XYZ University",
    universityImage:
      "https://lepublicassets.leverageedu.com/testimonials/universities/109.png",
  },
  {
    name: "Jane Smith",
    image: "https://publicassets.leverageedu.com/stories/kshitij.webp",
    story:
      "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est itaque cupiditate perferendis maxime, praesentium, id expedita, ipsam quasi eum ducimus nostrum et totam eos culpa ad voluptatum tenetur placeat consequuntur.",
    stream: "Web Developer",
    university: "XYZ University",
    universityImage:
      "https://lepublicassets.leverageedu.com/testimonials/universities/109.png",
  },
  {
    name: "Jane Smith",
    image: "https://publicassets.leverageedu.com/stories/kshitij.webp",
    story:
      "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est itaque cupiditate perferendis maxime, praesentium, id expedita, ipsam quasi eum ducimus nostrum et totam eos culpa ad voluptatum tenetur placeat consequuntur.",
    stream: "Web Developer",
    university: "XYZ University",
    universityImage:
      "https://lepublicassets.leverageedu.com/testimonials/universities/109.png",
  },
  {
    name: "Jane Smith",
    image: "https://publicassets.leverageedu.com/stories/kshitij.webp",
    story:
      "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est itaque cupiditate perferendis maxime, praesentium, id expedita, ipsam quasi eum ducimus nostrum et totam eos culpa ad voluptatum tenetur placeat consequuntur.",
    stream: "Web Developer",
    university: "XYZ University",
    universityImage:
      "https://lepublicassets.leverageedu.com/testimonials/universities/109.png",
  },
  {
    name: "Jane Smith",
    image: "https://publicassets.leverageedu.com/stories/kshitij.webp",
    story:
      "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est itaque cupiditate perferendis maxime, praesentium, id expedita, ipsam quasi eum ducimus nostrum et totam eos culpa ad voluptatum tenetur placeat consequuntur.",
    stream: "Web Developer",
    university: "XYZ University",
    universityImage:
      "https://lepublicassets.leverageedu.com/testimonials/universities/109.png",
  },
  {
    name: "Jane Smith",
    image: "https://publicassets.leverageedu.com/stories/kshitij.webp",
    story:
      "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est itaque cupiditate perferendis maxime, praesentium, id expedita, ipsam quasi eum ducimus nostrum et totam eos culpa ad voluptatum tenetur placeat consequuntur.",
    stream: "Web Developer",
    university: "XYZ University",
    universityImage:
      "https://lepublicassets.leverageedu.com/testimonials/universities/109.png",
  },
  {
    name: "Jane Smith",
    image: "https://publicassets.leverageedu.com/stories/kshitij.webp",
    story:
      "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est itaque cupiditate perferendis maxime, praesentium, id expedita, ipsam quasi eum ducimus nostrum et totam eos culpa ad voluptatum tenetur placeat consequuntur.",
    stream: "Web Developer",
    university: "XYZ University",
    universityImage:
      "https://lepublicassets.leverageedu.com/testimonials/universities/109.png",
  },
];
initStories();
