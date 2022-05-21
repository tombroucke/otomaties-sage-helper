# ACF Objects

## Installation

```sh
composer require tombroucke/otomaties-sage-helper
```

## Usage
```sh
wp acorn vendor:publish --tag="Otomaties block {Block Name}"
```

## Blocks

### Accordion

`wp acorn vendor:publish --tag="Otomaties block Accordion"`

### Banner

`wp acorn vendor:publish --tag="Otomaties block Banner"`

- Show H1 with background image

### Button

`wp acorn vendor:publish --tag="Otomaties block Button"`

- Single inline-block button

### Buttons

`wp acorn vendor:publish --tag="Otomaties block Buttons"`

- Display one or more buttons
- Group buttons

### Cards

`wp acorn vendor:publish --tag="Otomaties block Cards"`

### Carousel

`wp acorn vendor:publish --tag="Otomaties block Carousel"`

- Slick carousel
- Slick parameters in data-attribute. Append / overwrite settings in JS
- Add `$('.wp-block-carousel__slider').slick();` to your JS

### Container

`wp acorn vendor:publish --tag="Otomaties block Container"`

- Container with background
- Full width, wide or regular

### Gallery

`wp acorn vendor:publish --tag="Otomaties block Gallery"`

### Hero

`wp acorn vendor:publish --tag="Otomaties block Hero"`

### Hero Slider

`wp acorn vendor:publish --tag="Otomaties block HeroSlider"`

- Slick carousel
- Add `$('.wp-block-hero-slider').slick();` to your JS

### Image + Content

`wp acorn vendor:publish --tag="Otomaties block ImageContent"`

- Image & content (Innerblocks)
- Choose image position
- Background color

### Latest Posts

`wp acorn vendor:publish --tag="Otomaties block LatestPosts"`

- Display latest posts
- Choose number of posts to display
- Modify to change post type

### Location

`wp acorn vendor:publish --tag="Otomaties block Location"`

- Add scripts/blocks/location.js to webpack.mix.js: mix.js('resources/scripts/blocks/location.js', 'scripts/blocks')

### Logos

`wp acorn vendor:publish --tag="Otomaties block Logos"`

- Choose grid or carousel view
- In case you choose carousel view: add `$('.wp-block-logos__slider').slick();` to your JS

### Post Type Archive

`wp acorn vendor:publish --tag="Otomaties block PostTypeArchive"`

- Display post type archive
