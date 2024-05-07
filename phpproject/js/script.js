
function toggleInfo(card) {
    var info = card.querySelector('.pet-card-info');
    info.classList.toggle('show');
}

var cards = document.querySelectorAll('.pet-card');

cards.forEach(function(card) {
    card.addEventListener('click', function() {
        toggleInfo(card);
    });
});
