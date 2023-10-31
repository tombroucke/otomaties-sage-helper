# Otomaties Sage Helper

## Installation

```sh
composer require tombroucke/otomaties-sage-helper --dev
```

## Usage
```sh
wp acorn vendor:publish --tag="Otomaties block {Block Name}"
```

## Blocks

### Accordion

`wp acorn vendor:publish --tag="Otomaties block Accordion"`
> Needs some javascript, see https://github.com/tombroucke/sage-bootstrap-components#accordion

### Banner

`wp acorn vendor:publish --tag="Otomaties block Banner"`

- Show H1 with background image

### Buttons

`wp acorn vendor:publish --tag="Otomaties block Buttons"`

- Display one or more buttons
- Group buttons

### Cards

`wp acorn vendor:publish --tag="Otomaties block Cards"`

### Carousel

`wp acorn vendor:publish --tag="Otomaties block Carousel"`

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

### Logos

`wp acorn vendor:publish --tag="Otomaties block Logos"`

- Choose grid or carousel view

### Post Type Archive

When using the same slug as the post type, pagination will not work. E.g. post type job, rewrite jobs, example.com/jobs/page/2 will throw a 404.

`wp acorn vendor:publish --tag="Otomaties block PostTypeArchive"`

- Display post type archive
