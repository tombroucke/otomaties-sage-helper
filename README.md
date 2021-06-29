# ACF Objects

## Installation

```sh
composer require tombroucke/otomaties-sage-helper
```

## Usage
```sh
wp acorn vendor:publish --tag="Otomaties default files"
```
```sh
wp acorn vendor:publish --tag="Otomaties block {Block Name}"
```

## Blocks

###Accordion
###Banner

- Show H1 with background image

###Buttons

- Display one or more buttons
- Group buttons

###Cards
###Carousel

- Slick carousel
- Slick parameters in data-attribute. Append / overwrite settings in JS
- Add `$('.wp-block-carousel__slider').slick();` to your JS

###ColoredBackground
###Gallery
###Header
###Hero
###HeroSlider

- Slick carousel
- Add `$('.wp-block-hero-slider').slick();` to your JS

###ImageContent

- Image & content (Innerblocks)
- Choose image position
- Background color

###LatestPosts

- Display latest posts
- Choose number of posts to display
- Modify to change post type

###Location (coming soon)
###Logos (coming soon)