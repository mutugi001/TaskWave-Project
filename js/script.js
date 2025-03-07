document.addEventListener("DOMContentLoaded", function () {
    // Select all elements with 'profile-initial' class
    const profileInitials = document.querySelectorAll(".profile-initial");

    profileInitials.forEach((element) => {
        let name = element.getAttribute("data-name");
        if (name) {
            let initials = name
                .split(" ")
                .map(word => word[0])
                .join("")
                .toUpperCase();
            element.innerText = initials;
        }
    });
});

/* JS to trigger animations on scroll */

document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll(".hero-section, .project-section, .testimonials-section, .footer");
    const attributes = document.querySelectorAll(".attribute");
    const testimonials = document.querySelectorAll(".testimonial-card");

    function revealOnScroll() {
        let scrollPosition = window.scrollY + window.innerHeight * 0.75;

        sections.forEach((section) => {
            if (scrollPosition > section.offsetTop) {
                section.classList.add("show");
            }
        });

        attributes.forEach((attr) => {
            if (scrollPosition > attr.offsetTop) {
                attr.classList.add("show");
            }
        });

        testimonials.forEach((testimonial) => {
            if (scrollPosition > testimonial.offsetTop) {
                testimonial.classList.add("show");
            }
        });
    }

    window.addEventListener("scroll", revealOnScroll);
    revealOnScroll();
});

