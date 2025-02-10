const hamburgerMenu = document.getElementById('hamburger-menu');
const hamburgerMenuBtn = document.getElementById('hamburger-btn');
const hamburgerOpenIcon = document.getElementById('hamburger-open-icon');
const hamburgerCloseIcon = document.getElementById('hamburger-close-icon');

const dropdownEl = document.getElementById('dropdown-menu');
const dropdownBtn = document.getElementById('dropdown-btn');

createDropdown(hamburgerMenu, hamburgerMenuBtn, hamburgerOpenIcon, hamburgerCloseIcon);
createDropdown(dropdownEl, dropdownBtn);

function createDropdown(menuEl, menuBtn, openIcon = null, closeIcon = null) {
    menuBtn.addEventListener('click', () => {
        let nameOfClass = 'hidden';
        if (window.innerWidth >= breakpoints['md']) {
            nameOfClass = 'md:block';
        }

        if (openIcon && closeIcon) {
            openIcon.classList.toggle(nameOfClass);
            closeIcon.classList.toggle(nameOfClass);
        }
        menuEl.classList.toggle(nameOfClass);
    });
}
