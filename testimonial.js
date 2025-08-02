// Testimonial slider JS
const testimonials = [
    {
        img: "images.jpeg",
        text: '"Our family had a fantastic time staying at one of VA Mountain Cabins\' rentals. The property was immaculate and had everything we needed for a comfortable stay. The customer service was top-notch, with prompt communication and thoughtful touches throughout our stay!"',
        name: 'Emma & Mike',
        location: 'Nashville, TN',
        initials: 'E&M',
        rating: '5.0'
    },
    {
        img: "images.jpeg",
        text: '"The location was perfect and the home was beautiful. We loved every moment of our stay in the mountains. The views were breathtaking and we will definitely be back next year!"',
        name: 'Sarah',
        location: 'Atlanta, GA',
        initials: 'S',
        rating: '4.9'
    },
    {
        img: "images.jpeg",
        text: '"Amazing experience! The staff was friendly and the property was even better than the photos. Our family had the most relaxing vacation we\'ve had in years. Highly recommend!"',
        name: 'John & Lisa',
        location: 'Dallas, TX',
        initials: 'J&L',
        rating: '5.0'
    }
];

let currentTestimonial = 0;

function updateTestimonial(idx) {
    const testimonialImg = document.querySelector('.testimonial-img');
    const testimonialText = document.querySelector('.testimonial-text');
    const testimonialRating = document.querySelector('.bg-white.shadow .fw-bold');
    const testimonialInitials = document.querySelector('.testimonial-author .rounded-circle span');
    const testimonialName = document.querySelector('.testimonial-author .fw-bold');
    const testimonialLocation = document.querySelector('.testimonial-author .text-secondary-dark');
    
    testimonialImg.src = testimonials[idx].img;
    testimonialText.textContent = testimonials[idx].text;
    if (testimonialRating) testimonialRating.textContent = testimonials[idx].rating;
    if (testimonialInitials) testimonialInitials.textContent = testimonials[idx].initials;
    if (testimonialName) testimonialName.textContent = testimonials[idx].name;
    if (testimonialLocation) testimonialLocation.textContent = testimonials[idx].location;
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('testimonial-prev').addEventListener('click', function () {
        currentTestimonial = (currentTestimonial - 1 + testimonials.length) % testimonials.length;
        updateTestimonial(currentTestimonial);
    });
    document.getElementById('testimonial-next').addEventListener('click', function () {
        currentTestimonial = (currentTestimonial + 1) % testimonials.length;
        updateTestimonial(currentTestimonial);
    });
});
