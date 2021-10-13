const tags = document.querySelectorAll(".tag-item-search");

function changeTagColor() {
    const colors = ['red', 'turquoise', 'blue', 'chocolate', 'purple'];
    return colors[Math.floor( Math.random() * colors.length)];
}

for (let i = 0; i < tags.length; i++ ) {

    let color = changeTagColor();
    let tag = tags[i];

    tag.style.borderColor = color;

    tag.addEventListener("mouseover", function() {
        tag.style.backgroundColor = color;
        tag.style.color = 'white';
    });

    tag.addEventListener("mouseleave", function() {
        tag.style.removeProperty('background-color');
        tag.style.removeProperty('color');
    });
}