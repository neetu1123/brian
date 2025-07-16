// Testimonial slider JS
const testimonials = [
    {
        img: "https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80",
        text: '"OUR FAMILY HAD A FANTASTIC TIME STAYING AT ONE OF KISMET PROPERTIES\' RENTALS. THE PROPERTY WAS IMMACULATE AND HAD EVERYTHING WE NEEDED FOR A COMFORTABLE STAY. THE CUSTOMER SERVICE WAS TOP-NOTCH, WITH PROMPT COMMUNICATION AND THOUGHTFUL TOUCHES THROUGHOUT OUR STAY!"',
        author: '— Emma & Mike from Nashville, TN'
    },
    {
        img: "https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=800&q=80",
        text: '"THE LOCATION WAS PERFECT AND THE HOME WAS BEAUTIFUL. WE WILL DEFINITELY BE BACK NEXT YEAR!"',
        author: '— Sarah from Atlanta, GA'
    },
    {
        img: "https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80",
        text: '"AMAZING EXPERIENCE! THE STAFF WAS FRIENDLY AND THE PROPERTY WAS EVEN BETTER THAN THE PHOTOS."',
        author: '— John & Lisa from Dallas, TX'
    }
];

let currentTestimonial = 0;

function updateTestimonial(idx) {
    const testimonialImg = document.querySelector('.testimonial-img');
    const testimonialText = document.querySelector('.testimonial-text');
    const testimonialAuthor = document.querySelector('.testimonial-author');
    testimonialImg.src = testimonials[idx].img;
    testimonialText.textContent = testimonials[idx].text;
    testimonialAuthor.textContent = testimonials[idx].author;
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
