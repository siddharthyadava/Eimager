<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EImager</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="css/custom.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <style>
        /* Basic styling */
        .header {
            display: flex;
            justify-content: flex-end;
            padding: 15px;
            background-color: #f8f9fa;
            /* box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); */
        }

        .header a {
            text-decoration: none;
            padding: 10px 15px;
            margin-left: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .login {
            background-color: white;
            color: rgb(2, 0, 36);
            border: 1px solid rgba(2, 0, 36, 1);

        }

        .register {
            /* background-color: #ff2d20;
            color: white; */
            background-color: white;
            color: rgb(2, 0, 36);
            border: 1px solid rgba(2, 0, 36, 1);

        }

        .hr-portal {
            background-color: white;
            color: rgb(2, 0, 36);
            border: 1px solid rgba(2, 0, 36, 1);
        }

        .header a:hover {
            opacity: 0.8;
        }

        /* ! tailwindcss v3.4.17 | MIT License | https://tailwindcss.com */
        *,
        :before,
        :after {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / .5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia: ;
            --tw-contain-size: ;
            --tw-contain-layout: ;
            --tw-contain-paint: ;
            --tw-contain-style:
        }

        ::backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-gradient-from-position: ;
            --tw-gradient-via-position: ;
            --tw-gradient-to-position: ;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / .5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia: ;
            --tw-contain-size: ;
            --tw-contain-layout: ;
            --tw-contain-paint: ;
            --tw-contain-style:
        }

        *,
        :before,
        :after {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e5e7eb
        }

        :before,
        :after {
            --tw-content: ""
        }

        html,
        :host {
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -moz-tab-size: 4;
            -o-tab-size: 4;
            tab-size: 4;
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", Segoe UI Symbol, "Noto Color Emoji";
            font-feature-settings: normal;
            font-variation-settings: normal;
            -webkit-tap-highlight-color: transparent
        }

        body {
            margin: 0;
            line-height: inherit
        }

        hr {
            height: 0;
            color: inherit;
            border-top-width: 1px
        }

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        b,
        strong {
            font-weight: bolder
        }

        code,
        kbd,
        samp,
        pre {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, Liberation Mono, Courier New, monospace;
            font-feature-settings: normal;
            font-variation-settings: normal;
            font-size: 1em
        }

        small {
            font-size: 80%
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        table {
            text-indent: 0;
            border-color: inherit;
            border-collapse: collapse
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: inherit;
            font-feature-settings: inherit;
            font-variation-settings: inherit;
            font-size: 100%;
            font-weight: inherit;
            line-height: inherit;
            letter-spacing: inherit;
            color: inherit;
            margin: 0;
            padding: 0
        }

        button,
        select {
            text-transform: none
        }

        button,
        input:where([type=button]),
        input:where([type=reset]),
        input:where([type=submit]) {
            -webkit-appearance: button;
            background-color: transparent;
            background-image: none
        }

        :-moz-focusring {
            outline: auto
        }

        :-moz-ui-invalid {
            box-shadow: none
        }

        progress {
            vertical-align: baseline
        }

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto
        }

        [type=search] {
            -webkit-appearance: textfield;
            outline-offset: -2px
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font: inherit
        }

        summary {
            display: list-item
        }

        blockquote,
        dl,
        dd,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        figure,
        p,
        pre {
            margin: 0
        }

        fieldset {
            margin: 0;
            padding: 0
        }

        legend {
            padding: 0
        }

        ol,
        ul,
        menu {
            list-style: none;
            margin: 0;
            padding: 0
        }

        dialog {
            padding: 0
        }

        textarea {
            resize: vertical
        }

        input::-moz-placeholder,
        textarea::-moz-placeholder {
            opacity: 1;
            color: #9ca3af
        }

        input::placeholder,
        textarea::placeholder {
            opacity: 1;
            color: #9ca3af
        }

        button,
        [role=button] {
            cursor: pointer
        }

        :disabled {
            cursor: default
        }

        img,
        svg,
        video,
        canvas,
        audio,
        iframe,
        embed,
        object {
            display: block;
            vertical-align: middle
        }

        img,
        video {
            max-width: 100%;
            height: auto
        }

        [hidden]:where(:not([hidden=until-found])) {
            display: none
        }

        .absolute {
            position: absolute
        }

        .relative {
            position: relative
        }

        .-bottom-16 {
            bottom: -4rem
        }

        .-left-16 {
            left: -4rem
        }

        .-left-20 {
            left: -5rem
        }

        .top-0 {
            top: 0
        }

        .z-0 {
            z-index: 0
        }

        .\!row-span-1 {
            grid-row: span 1 / span 1 !important
        }

        .-mx-3 {
            margin-left: -.75rem;
            margin-right: -.75rem
        }

        .-ml-px {
            margin-left: -1px
        }

        .ml-3 {
            margin-left: .75rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .mt-6 {
            margin-top: 1.5rem
        }

        .flex {
            display: flex
        }

        .inline-flex {
            display: inline-flex
        }

        .table {
            display: table
        }

        .grid {
            display: grid
        }

        .\!hidden {
            display: none !important
        }

        .hidden {
            display: none
        }

        .aspect-video {
            aspect-ratio: 16 / 9
        }

        .size-12 {
            width: 3rem;
            height: 3rem
        }

        .size-5 {
            width: 1.25rem;
            height: 1.25rem
        }

        .size-6 {
            width: 1.5rem;
            height: 1.5rem
        }

        .h-12 {
            height: 3rem
        }

        .h-40 {
            height: 10rem
        }

        .h-5 {
            height: 1.25rem
        }

        .h-full {
            height: 100%
        }

        .min-h-screen {
            min-height: 100vh
        }

        .w-5 {
            width: 1.25rem
        }

        .w-\[calc\(100\%_\+_8rem\)\] {
            width: calc(100% + 8rem)
        }

        .w-auto {
            width: auto
        }

        .w-full {
            width: 100%
        }

        .max-w-2xl {
            max-width: 42rem
        }

        .max-w-\[877px\] {
            max-width: 877px
        }

        .flex-1 {
            flex: 1 1 0%
        }

        .shrink-0 {
            flex-shrink: 0
        }

        .transform {
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skew(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
        }

        .cursor-default {
            cursor: default
        }

        .resize {
            resize: both
        }

        .grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr))
        }

        .\!flex-row {
            flex-direction: row !important
        }

        .flex-col {
            flex-direction: column
        }

        .items-start {
            align-items: flex-start
        }

        .items-center {
            align-items: center
        }

        .items-stretch {
            align-items: stretch
        }

        .justify-end {
            justify-content: flex-end
        }

        .justify-center {
            justify-content: center
        }

        .justify-between {
            justify-content: space-between
        }

        .justify-items-center {
            justify-items: center
        }

        .gap-2 {
            gap: .5rem
        }

        .gap-4 {
            gap: 1rem
        }

        .gap-6 {
            gap: 1.5rem
        }

        .self-center {
            align-self: center
        }

        .overflow-hidden {
            overflow: hidden
        }

        .rounded-\[10px\] {
            border-radius: 10px
        }

        .rounded-full {
            border-radius: 9999px
        }

        .rounded-lg {
            border-radius: .5rem
        }

        .rounded-md {
            border-radius: .375rem
        }

        .rounded-sm {
            border-radius: .125rem
        }

        .rounded-l-md {
            border-top-left-radius: .375rem;
            border-bottom-left-radius: .375rem
        }

        .rounded-r-md {
            border-top-right-radius: .375rem;
            border-bottom-right-radius: .375rem
        }

        .border {
            border-width: 1px
        }

        .border-gray-300 {
            --tw-border-opacity: 1;
            border-color: rgb(209 213 219 / var(--tw-border-opacity, 1))
        }

        .bg-\[\#FF2D20\]\/10 {
            background-color: #ff2d201a
        }

        .bg-gray-50 {
            --tw-bg-opacity: 1;
            background-color: rgb(249 250 251 / var(--tw-bg-opacity, 1))
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity, 1))
        }

        .bg-gradient-to-b {
            background-image: linear-gradient(to bottom, var(--tw-gradient-stops))
        }

        .from-transparent {
            --tw-gradient-from: transparent var(--tw-gradient-from-position);
            --tw-gradient-to: rgb(0 0 0 / 0) var(--tw-gradient-to-position);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
        }

        .via-white {
            --tw-gradient-to: rgb(255 255 255 / 0) var(--tw-gradient-to-position);
            --tw-gradient-stops: var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)
        }

        .to-white {
            --tw-gradient-to: #fff var(--tw-gradient-to-position)
        }

        .to-zinc-900 {
            --tw-gradient-to: #18181b var(--tw-gradient-to-position)
        }

        .stroke-\[\#FF2D20\] {
            stroke: #ff2d20
        }

        .object-cover {
            -o-object-fit: cover;
            object-fit: cover
        }

        .object-top {
            -o-object-position: top;
            object-position: top
        }

        .p-6 {
            padding: 1.5rem
        }

        .px-2 {
            padding-left: .5rem;
            padding-right: .5rem
        }

        .px-3 {
            padding-left: .75rem;
            padding-right: .75rem
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .py-10 {
            padding-top: 2.5rem;
            padding-bottom: 2.5rem
        }

        .py-16 {
            padding-top: 4rem;
            padding-bottom: 4rem
        }

        .py-2 {
            padding-top: .5rem;
            padding-bottom: .5rem
        }

        .pt-3 {
            padding-top: .75rem
        }

        .text-center {
            text-align: center
        }

        .font-sans {
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", Segoe UI Symbol, "Noto Color Emoji"
        }

        .text-sm {
            font-size: .875rem;
            line-height: 1.25rem
        }

        .text-sm\/relaxed {
            font-size: .875rem;
            line-height: 1.625
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem
        }

        .font-medium {
            font-weight: 500
        }

        .font-semibold {
            font-weight: 600
        }

        .leading-5 {
            line-height: 1.25rem
        }

        .text-black {
            --tw-text-opacity: 1;
            color: rgb(0 0 0 / var(--tw-text-opacity, 1))
        }

        .text-black\/50 {
            color: #00000080
        }

        .text-gray-500 {
            --tw-text-opacity: 1;
            color: rgb(107 114 128 / var(--tw-text-opacity, 1))
        }

        .text-gray-700 {
            --tw-text-opacity: 1;
            color: rgb(55 65 81 / var(--tw-text-opacity, 1))
        }

        .text-white {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity, 1))
        }

        .underline {
            text-decoration-line: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .shadow-\[0px_14px_34px_0px_rgba\(0\,0\,0\,0\.08\)\] {
            --tw-shadow: 0px 14px 34px 0px rgba(0, 0, 0, .08);
            --tw-shadow-colored: 0px 14px 34px 0px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .shadow-sm {
            --tw-shadow: 0 1px 2px 0 rgb(0 0 0 / .05);
            --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .ring-1 {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
        }

        .ring-black {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(0 0 0 / var(--tw-ring-opacity, 1))
        }

        .ring-gray-300 {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(209 213 219 / var(--tw-ring-opacity, 1))
        }

        .ring-transparent {
            --tw-ring-color: transparent
        }

        .ring-white {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(255 255 255 / var(--tw-ring-opacity, 1))
        }

        .ring-white\/\[0\.05\] {
            --tw-ring-color: rgb(255 255 255 / .05)
        }

        .drop-shadow-\[0px_4px_34px_rgba\(0\,0\,0\,0\.06\)\] {
            --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, .06));
            filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
        }

        .drop-shadow-\[0px_4px_34px_rgba\(0\,0\,0\,0\.25\)\] {
            --tw-drop-shadow: drop-shadow(0px 4px 34px rgba(0, 0, 0, .25));
            filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
        }

        .filter {
            filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)
        }

        .transition {
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-backdrop-filter;
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-backdrop-filter;
            transition-timing-function: cubic-bezier(.4, 0, .2, 1);
            transition-duration: .15s
        }

        .duration-150 {
            transition-duration: .15s
        }

        .duration-300 {
            transition-duration: .3s
        }

        .ease-in-out {
            transition-timing-function: cubic-bezier(.4, 0, .2, 1)
        }

        .selection\:bg-\[\#FF2D20\] *::-moz-selection {
            --tw-bg-opacity: 1;
            background-color: rgb(255 45 32 / var(--tw-bg-opacity, 1))
        }

        .selection\:bg-\[\#FF2D20\] *::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(255 45 32 / var(--tw-bg-opacity, 1))
        }

        .selection\:text-white *::-moz-selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity, 1))
        }

        .selection\:text-white *::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity, 1))
        }

        .selection\:bg-\[\#FF2D20\]::-moz-selection {
            --tw-bg-opacity: 1;
            background-color: rgb(255 45 32 / var(--tw-bg-opacity, 1))
        }

        .selection\:bg-\[\#FF2D20\]::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(255 45 32 / var(--tw-bg-opacity, 1))
        }

        .selection\:text-white::-moz-selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity, 1))
        }

        .selection\:text-white::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity, 1))
        }

        .hover\:text-black:hover {
            --tw-text-opacity: 1;
            color: rgb(0 0 0 / var(--tw-text-opacity, 1))
        }

        .hover\:text-black\/70:hover {
            color: #000000b3
        }

        .hover\:text-gray-400:hover {
            --tw-text-opacity: 1;
            color: rgb(156 163 175 / var(--tw-text-opacity, 1))
        }

        .hover\:text-gray-500:hover {
            --tw-text-opacity: 1;
            color: rgb(107 114 128 / var(--tw-text-opacity, 1))
        }

        .hover\:ring-black\/20:hover {
            --tw-ring-color: rgb(0 0 0 / .2)
        }

        .focus\:z-10:focus {
            z-index: 10
        }

        .focus\:border-blue-300:focus {
            --tw-border-opacity: 1;
            border-color: rgb(147 197 253 / var(--tw-border-opacity, 1))
        }

        .focus\:outline-none:focus {
            outline: 2px solid transparent;
            outline-offset: 2px
        }

        .focus\:ring:focus {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
        }

        .focus-visible\:ring-1:focus-visible {
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
        }

        .focus-visible\:ring-\[\#FF2D20\]:focus-visible {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity, 1))
        }

        .active\:bg-gray-100:active {
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246 / var(--tw-bg-opacity, 1))
        }

        .active\:text-gray-500:active {
            --tw-text-opacity: 1;
            color: rgb(107 114 128 / var(--tw-text-opacity, 1))
        }

        .active\:text-gray-700:active {
            --tw-text-opacity: 1;
            color: rgb(55 65 81 / var(--tw-text-opacity, 1))
        }

        @media (min-width: 640px) {
            .sm\:flex {
                display: flex
            }

            .sm\:hidden {
                display: none
            }

            .sm\:size-16 {
                width: 4rem;
                height: 4rem
            }

            .sm\:size-6 {
                width: 1.5rem;
                height: 1.5rem
            }

            .sm\:flex-1 {
                flex: 1 1 0%
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:pt-5 {
                padding-top: 1.25rem
            }
        }

        @media (min-width: 768px) {
            .md\:row-span-3 {
                grid-row: span 3 / span 3
            }
        }

        @media (min-width: 1024px) {
            .lg\:col-start-2 {
                grid-column-start: 2
            }

            .lg\:h-16 {
                height: 4rem
            }

            .lg\:max-w-7xl {
                max-width: 80rem
            }

            .lg\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }

            .lg\:grid-cols-3 {
                grid-template-columns: repeat(3, minmax(0, 1fr))
            }

            .lg\:flex-col {
                flex-direction: column
            }

            .lg\:items-end {
                align-items: flex-end
            }

            .lg\:justify-center {
                justify-content: center
            }

            .lg\:gap-8 {
                gap: 2rem
            }

            .lg\:p-10 {
                padding: 2.5rem
            }

            .lg\:pb-10 {
                padding-bottom: 2.5rem
            }

            .lg\:pt-0 {
                padding-top: 0
            }

            .lg\:text-\[\#FF2D20\] {
                --tw-text-opacity: 1;
                color: rgb(255 45 32 / var(--tw-text-opacity, 1))
            }
        }

        .rtl\:flex-row-reverse:where([dir=rtl], [dir=rtl] *) {
            flex-direction: row-reverse
        }

        @media (prefers-color-scheme: dark) {
            .dark\:block {
                display: block
            }

            .dark\:hidden {
                display: none
            }

            .dark\:border-gray-600 {
                --tw-border-opacity: 1;
                border-color: rgb(75 85 99 / var(--tw-border-opacity, 1))
            }

            .dark\:bg-black {
                --tw-bg-opacity: 1;
                background-color: rgb(0 0 0 / var(--tw-bg-opacity, 1))
            }

            .dark\:bg-gray-800 {
                --tw-bg-opacity: 1;
                background-color: rgb(31 41 55 / var(--tw-bg-opacity, 1))
            }

            .dark\:bg-zinc-900 {
                --tw-bg-opacity: 1;
                background-color: rgb(24 24 27 / var(--tw-bg-opacity, 1))
            }

            .dark\:via-zinc-900 {
                --tw-gradient-to: rgb(24 24 27 / 0) var(--tw-gradient-to-position);
                --tw-gradient-stops: var(--tw-gradient-from), #18181b var(--tw-gradient-via-position), var(--tw-gradient-to)
            }

            .dark\:to-zinc-900 {
                --tw-gradient-to: #18181b var(--tw-gradient-to-position)
            }

            .dark\:text-gray-300 {
                --tw-text-opacity: 1;
                color: rgb(209 213 219 / var(--tw-text-opacity, 1))
            }

            .dark\:text-gray-400 {
                --tw-text-opacity: 1;
                color: rgb(156 163 175 / var(--tw-text-opacity, 1))
            }

            .dark\:text-gray-600 {
                --tw-text-opacity: 1;
                color: rgb(75 85 99 / var(--tw-text-opacity, 1))
            }

            .dark\:text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity, 1))
            }

            .dark\:text-white\/50 {
                color: #ffffff80
            }

            .dark\:text-white\/70 {
                color: #ffffffb3
            }

            .dark\:ring-zinc-800 {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(39 39 42 / var(--tw-ring-opacity, 1))
            }

            .dark\:hover\:text-gray-300:hover {
                --tw-text-opacity: 1;
                color: rgb(209 213 219 / var(--tw-text-opacity, 1))
            }

            .dark\:hover\:text-white:hover {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity, 1))
            }

            .dark\:hover\:text-white\/70:hover {
                color: #ffffffb3
            }

            .dark\:hover\:text-white\/80:hover {
                color: #fffc
            }

            .dark\:hover\:ring-zinc-700:hover {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(63 63 70 / var(--tw-ring-opacity, 1))
            }

            .dark\:focus\:border-blue-700:focus {
                --tw-border-opacity: 1;
                border-color: rgb(29 78 216 / var(--tw-border-opacity, 1))
            }

            .dark\:focus\:border-blue-800:focus {
                --tw-border-opacity: 1;
                border-color: rgb(30 64 175 / var(--tw-border-opacity, 1))
            }

            .dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(255 45 32 / var(--tw-ring-opacity, 1))
            }

            .dark\:focus-visible\:ring-white:focus-visible {
                --tw-ring-opacity: 1;
                --tw-ring-color: rgb(255 255 255 / var(--tw-ring-opacity, 1))
            }

            .dark\:active\:bg-gray-700:active {
                --tw-bg-opacity: 1;
                background-color: rgb(55 65 81 / var(--tw-bg-opacity, 1))
            }

            .dark\:active\:text-gray-300:active {
                --tw-text-opacity: 1;
                color: rgb(209 213 219 / var(--tw-text-opacity, 1))
            }
        }
    </style>
    @endif
</head>
<!-- <body class="font-sans antialiased dark:bg-black dark:text-white/50"> -->

<body>
    <!-- <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" alt="Laravel background" />
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            <svg class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20]" viewBox="0 0 62 65" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M61.8548 14.6253C61.8778 14.7102 61.8895 14.7978 61.8897 14.8858V28.5615C61.8898 28.737 61.8434 28.9095 61.7554 29.0614C61.6675 29.2132 61.5409 29.3392 61.3887 29.4265L49.9104 36.0351V49.1337C49.9104 49.4902 49.7209 49.8192 49.4118 49.9987L25.4519 63.7916C25.3971 63.8227 25.3372 63.8427 25.2774 63.8639C25.255 63.8714 25.2338 63.8851 25.2101 63.8913C25.0426 63.9354 24.8666 63.9354 24.6991 63.8913C24.6716 63.8838 24.6467 63.8689 24.6205 63.8589C24.5657 63.8389 24.5084 63.8215 24.456 63.7916L0.501061 49.9987C0.348882 49.9113 0.222437 49.7853 0.134469 49.6334C0.0465019 49.4816 0.000120578 49.3092 0 49.1337L0 8.10652C0 8.01678 0.0124642 7.92953 0.0348998 7.84477C0.0423783 7.8161 0.0598282 7.78993 0.0697995 7.76126C0.0884958 7.70891 0.105946 7.65531 0.133367 7.6067C0.152063 7.5743 0.179485 7.54812 0.20192 7.51821C0.230588 7.47832 0.256763 7.43719 0.290416 7.40229C0.319084 7.37362 0.356476 7.35243 0.388883 7.32751C0.425029 7.29759 0.457436 7.26518 0.498568 7.2415L12.4779 0.345059C12.6296 0.257786 12.8015 0.211853 12.9765 0.211853C13.1515 0.211853 13.3234 0.257786 13.475 0.345059L25.4531 7.2415H25.4556C25.4955 7.26643 25.5292 7.29759 25.5653 7.32626C25.5977 7.35119 25.6339 7.37362 25.6625 7.40104C25.6974 7.43719 25.7224 7.47832 25.7523 7.51821C25.7735 7.54812 25.8021 7.5743 25.8196 7.6067C25.8483 7.65656 25.8645 7.70891 25.8844 7.76126C25.8944 7.78993 25.9118 7.8161 25.9193 7.84602C25.9423 7.93096 25.954 8.01853 25.9542 8.10652V33.7317L35.9355 27.9844V14.8846C35.9355 14.7973 35.948 14.7088 35.9704 14.6253C35.9792 14.5954 35.9954 14.5692 36.0053 14.5405C36.0253 14.4882 36.0427 14.4346 36.0702 14.386C36.0888 14.3536 36.1163 14.3274 36.1375 14.2975C36.1674 14.2576 36.1923 14.2165 36.2272 14.1816C36.2559 14.1529 36.292 14.1317 36.3244 14.1068C36.3618 14.0769 36.3942 14.0445 36.4341 14.0208L48.4147 7.12434C48.5663 7.03694 48.7383 6.99094 48.9133 6.99094C49.0883 6.99094 49.2602 7.03694 49.4118 7.12434L61.3899 14.0208C61.4323 14.0457 61.4647 14.0769 61.5021 14.1055C61.5333 14.1305 61.5694 14.1529 61.5981 14.1803C61.633 14.2165 61.6579 14.2576 61.6878 14.2975C61.7103 14.3274 61.7377 14.3536 61.7551 14.386C61.7838 14.4346 61.8 14.4882 61.8199 14.5405C61.8312 14.5692 61.8474 14.5954 61.8548 14.6253ZM59.893 27.9844V16.6121L55.7013 19.0252L49.9104 22.3593V33.7317L59.8942 27.9844H59.893ZM47.9149 48.5566V37.1768L42.2187 40.4299L25.953 49.7133V61.2003L47.9149 48.5566ZM1.99677 9.83281V48.5566L23.9562 61.199V49.7145L12.4841 43.2219L12.4804 43.2194L12.4754 43.2169C12.4368 43.1945 12.4044 43.1621 12.3682 43.1347C12.3371 43.1097 12.3009 43.0898 12.2735 43.0624L12.271 43.0586C12.2386 43.0275 12.2162 42.9888 12.1887 42.9539C12.1638 42.9203 12.1339 42.8916 12.114 42.8567L12.1127 42.853C12.0903 42.8156 12.0766 42.7707 12.0604 42.7283C12.0442 42.6909 12.023 42.656 12.013 42.6161C12.0005 42.5688 11.998 42.5177 11.9931 42.4691C11.9881 42.4317 11.9781 42.3943 11.9781 42.3569V15.5801L6.18848 12.2446L1.99677 9.83281ZM12.9777 2.36177L2.99764 8.10652L12.9752 13.8513L22.9541 8.10527L12.9752 2.36177H12.9777ZM18.1678 38.2138L23.9574 34.8809V9.83281L19.7657 12.2459L13.9749 15.5801V40.6281L18.1678 38.2138ZM48.9133 9.14105L38.9344 14.8858L48.9133 20.6305L58.8909 14.8846L48.9133 9.14105ZM47.9149 22.3593L42.124 19.0252L37.9323 16.6121V27.9844L43.7219 31.3174L47.9149 33.7317V22.3593ZM24.9533 47.987L39.59 39.631L46.9065 35.4555L36.9352 29.7145L25.4544 36.3242L14.9907 42.3482L24.9533 47.987Z" fill="currentColor"/></svg>
                            
                        </div>
                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                        <div class="header">
                            <a href="{{ route('login-page') }}" class="login">Login</a>
                            <a href="{{ route('register-page') }}" class="register">Register</a>
                            <a href="{{ route('hr-register-page') }}" class="hr-portal">Employeer Login</a>
                            <a href="{{ route('admin-login') }}" class="hr-portal">Admin</a>
                        </div>
                    </header>
                    <main class="mt-6">
                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                            <a
                                href="https://laravel.com/docs"
                                id="docs-card"
                                class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                            >
                                <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
                                    <img
                                        src="https://laravel.com/assets/img/welcome/docs-light.svg"
                                        alt="Laravel documentation screenshot"
                                        class="aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.06)] dark:hidden"
                                        onerror="
                                            document.getElementById('screenshot-container').classList.add('!hidden');
                                            document.getElementById('docs-card').classList.add('!row-span-1');
                                            document.getElementById('docs-card-content').classList.add('!flex-row');
                                            document.getElementById('background').classList.add('!hidden');
                                        "
                                    />
                                    <img
                                        src="https://laravel.com/assets/img/welcome/docs-dark.svg"
                                        alt="Laravel documentation screenshot"
                                        class="hidden aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.25)] dark:block"
                                    />
                                    <div
                                        class="absolute -bottom-16 -left-16 h-40 w-[calc(100%_+_8rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900"
                                    ></div>
                                </div>

                                <div class="relative flex items-center gap-6 lg:items-end">
                                    <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                            <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path fill="#FF2D20" d="M23 4a1 1 0 0 0-1.447-.894L12.224 7.77a.5.5 0 0 1-.448 0L2.447 3.106A1 1 0 0 0 1 4v13.382a1.99 1.99 0 0 0 1.105 1.79l9.448 4.728c.14.065.293.1.447.1.154-.005.306-.04.447-.105l9.453-4.724a1.99 1.99 0 0 0 1.1-1.789V4ZM3 6.023a.25.25 0 0 1 .362-.223l7.5 3.75a.251.251 0 0 1 .138.223v11.2a.25.25 0 0 1-.362.224l-7.5-3.75a.25.25 0 0 1-.138-.22V6.023Zm18 11.2a.25.25 0 0 1-.138.224l-7.5 3.75a.249.249 0 0 1-.329-.099.249.249 0 0 1-.033-.12V9.772a.251.251 0 0 1 .138-.224l7.5-3.75a.25.25 0 0 1 .362.224v11.2Z"/><path fill="#FF2D20" d="m3.55 1.893 8 4.048a1.008 1.008 0 0 0 .9 0l8-4.048a1 1 0 0 0-.9-1.785l-7.322 3.706a.506.506 0 0 1-.452 0L4.454.108a1 1 0 0 0-.9 1.785H3.55Z"/></svg>
                                        </div>

                                        <div class="pt-3 sm:pt-5 lg:pt-0">
                                            <h2 class="text-xl font-semibold text-black dark:text-white">Documentation</h2>

                                            <p class="mt-4 text-sm/relaxed">
                                                Laravel has wonderful documentation covering every aspect of the framework. Whether you are a newcomer or have prior experience with Laravel, we recommend reading our documentation from beginning to end.
                                            </p>
                                        </div>
                                    </div>

                                    <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                                </div>
                            </a>

                            <a
                                href="https://laracasts.com"
                                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                            >
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><g fill="#FF2D20"><path d="M24 8.25a.5.5 0 0 0-.5-.5H.5a.5.5 0 0 0-.5.5v12a2.5 2.5 0 0 0 2.5 2.5h19a2.5 2.5 0 0 0 2.5-2.5v-12Zm-7.765 5.868a1.221 1.221 0 0 1 0 2.264l-6.626 2.776A1.153 1.153 0 0 1 8 18.123v-5.746a1.151 1.151 0 0 1 1.609-1.035l6.626 2.776ZM19.564 1.677a.25.25 0 0 0-.177-.427H15.6a.106.106 0 0 0-.072.03l-4.54 4.543a.25.25 0 0 0 .177.427h3.783c.027 0 .054-.01.073-.03l4.543-4.543ZM22.071 1.318a.047.047 0 0 0-.045.013l-4.492 4.492a.249.249 0 0 0 .038.385.25.25 0 0 0 .14.042h5.784a.5.5 0 0 0 .5-.5v-2a2.5 2.5 0 0 0-1.925-2.432ZM13.014 1.677a.25.25 0 0 0-.178-.427H9.101a.106.106 0 0 0-.073.03l-4.54 4.543a.25.25 0 0 0 .177.427H8.4a.106.106 0 0 0 .073-.03l4.54-4.543ZM6.513 1.677a.25.25 0 0 0-.177-.427H2.5A2.5 2.5 0 0 0 0 3.75v2a.5.5 0 0 0 .5.5h1.4a.106.106 0 0 0 .073-.03l4.54-4.543Z"/></g></svg>
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Laracasts</h2>

                                    <p class="mt-4 text-sm/relaxed">
                                        Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out, see for yourself, and massively level up your development skills in the process.
                                    </p>
                                </div>

                                <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                            </a>

                            <a
                                href="https://laravel-news.com"
                                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                            >
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><g fill="#FF2D20"><path d="M8.75 4.5H5.5c-.69 0-1.25.56-1.25 1.25v4.75c0 .69.56 1.25 1.25 1.25h3.25c.69 0 1.25-.56 1.25-1.25V5.75c0-.69-.56-1.25-1.25-1.25Z"/><path d="M24 10a3 3 0 0 0-3-3h-2V2.5a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2V20a3.5 3.5 0 0 0 3.5 3.5h17A3.5 3.5 0 0 0 24 20V10ZM3.5 21.5A1.5 1.5 0 0 1 2 20V3a.5.5 0 0 1 .5-.5h14a.5.5 0 0 1 .5.5v17c0 .295.037.588.11.874a.5.5 0 0 1-.484.625L3.5 21.5ZM22 20a1.5 1.5 0 1 1-3 0V9.5a.5.5 0 0 1 .5-.5H21a1 1 0 0 1 1 1v10Z"/><path d="M12.751 6.047h2a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-2A.75.75 0 0 1 12 7.3v-.5a.75.75 0 0 1 .751-.753ZM12.751 10.047h2a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-2A.75.75 0 0 1 12 11.3v-.5a.75.75 0 0 1 .751-.753ZM4.751 14.047h10a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-10A.75.75 0 0 1 4 15.3v-.5a.75.75 0 0 1 .751-.753ZM4.75 18.047h7.5a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-7.5A.75.75 0 0 1 4 19.3v-.5a.75.75 0 0 1 .75-.753Z"/></g></svg>
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Laravel News</h2>

                                    <p class="mt-4 text-sm/relaxed">
                                        Laravel News is a community driven portal and newsletter aggregating all of the latest and most important news in the Laravel ecosystem, including new package releases and tutorials.
                                    </p>
                                </div>

                                <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                            </a>

                            <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <g fill="#FF2D20">
                                            <path
                                                d="M16.597 12.635a.247.247 0 0 0-.08-.237 2.234 2.234 0 0 1-.769-1.68c.001-.195.03-.39.084-.578a.25.25 0 0 0-.09-.267 8.8 8.8 0 0 0-4.826-1.66.25.25 0 0 0-.268.181 2.5 2.5 0 0 1-2.4 1.824.045.045 0 0 0-.045.037 12.255 12.255 0 0 0-.093 3.86.251.251 0 0 0 .208.214c2.22.366 4.367 1.08 6.362 2.118a.252.252 0 0 0 .32-.079 10.09 10.09 0 0 0 1.597-3.733ZM13.616 17.968a.25.25 0 0 0-.063-.407A19.697 19.697 0 0 0 8.91 15.98a.25.25 0 0 0-.287.325c.151.455.334.898.548 1.328.437.827.981 1.594 1.619 2.28a.249.249 0 0 0 .32.044 29.13 29.13 0 0 0 2.506-1.99ZM6.303 14.105a.25.25 0 0 0 .265-.274 13.048 13.048 0 0 1 .205-4.045.062.062 0 0 0-.022-.07 2.5 2.5 0 0 1-.777-.982.25.25 0 0 0-.271-.149 11 11 0 0 0-5.6 2.815.255.255 0 0 0-.075.163c-.008.135-.02.27-.02.406.002.8.084 1.598.246 2.381a.25.25 0 0 0 .303.193 19.924 19.924 0 0 1 5.746-.438ZM9.228 20.914a.25.25 0 0 0 .1-.393 11.53 11.53 0 0 1-1.5-2.22 12.238 12.238 0 0 1-.91-2.465.248.248 0 0 0-.22-.187 18.876 18.876 0 0 0-5.69.33.249.249 0 0 0-.179.336c.838 2.142 2.272 4 4.132 5.353a.254.254 0 0 0 .15.048c1.41-.01 2.807-.282 4.117-.802ZM18.93 12.957l-.005-.008a.25.25 0 0 0-.268-.082 2.21 2.21 0 0 1-.41.081.25.25 0 0 0-.217.2c-.582 2.66-2.127 5.35-5.75 7.843a.248.248 0 0 0-.09.299.25.25 0 0 0 .065.091 28.703 28.703 0 0 0 2.662 2.12.246.246 0 0 0 .209.037c2.579-.701 4.85-2.242 6.456-4.378a.25.25 0 0 0 .048-.189 13.51 13.51 0 0 0-2.7-6.014ZM5.702 7.058a.254.254 0 0 0 .2-.165A2.488 2.488 0 0 1 7.98 5.245a.093.093 0 0 0 .078-.062 19.734 19.734 0 0 1 3.055-4.74.25.25 0 0 0-.21-.41 12.009 12.009 0 0 0-10.4 8.558.25.25 0 0 0 .373.281 12.912 12.912 0 0 1 4.826-1.814ZM10.773 22.052a.25.25 0 0 0-.28-.046c-.758.356-1.55.635-2.365.833a.25.25 0 0 0-.022.48c1.252.43 2.568.65 3.893.65.1 0 .2 0 .3-.008a.25.25 0 0 0 .147-.444c-.526-.424-1.1-.917-1.673-1.465ZM18.744 8.436a.249.249 0 0 0 .15.228 2.246 2.246 0 0 1 1.352 2.054c0 .337-.08.67-.23.972a.25.25 0 0 0 .042.28l.007.009a15.016 15.016 0 0 1 2.52 4.6.25.25 0 0 0 .37.132.25.25 0 0 0 .096-.114c.623-1.464.944-3.039.945-4.63a12.005 12.005 0 0 0-5.78-10.258.25.25 0 0 0-.373.274c.547 2.109.85 4.274.901 6.453ZM9.61 5.38a.25.25 0 0 0 .08.31c.34.24.616.561.8.935a.25.25 0 0 0 .3.127.631.631 0 0 1 .206-.034c2.054.078 4.036.772 5.69 1.991a.251.251 0 0 0 .267.024c.046-.024.093-.047.141-.067a.25.25 0 0 0 .151-.23A29.98 29.98 0 0 0 15.957.764a.25.25 0 0 0-.16-.164 11.924 11.924 0 0 0-2.21-.518.252.252 0 0 0-.215.076A22.456 22.456 0 0 0 9.61 5.38Z"
                                            />
                                        </g>
                                    </svg>
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Vibrant Ecosystem</h2>

                                    <p class="mt-4 text-sm/relaxed">
                                        Laravel's robust library of first-party tools and libraries, such as <a href="https://forge.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Forge</a>, <a href="https://vapor.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Vapor</a>, <a href="https://nova.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Nova</a>, <a href="https://envoyer.io" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Envoyer</a>, and <a href="https://herd.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Herd</a> help you take your projects to the next level. Pair them with powerful open source libraries like <a href="https://laravel.com/docs/billing" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Cashier</a>, <a href="https://laravel.com/docs/dusk" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Dusk</a>, <a href="https://laravel.com/docs/broadcasting" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Echo</a>, <a href="https://laravel.com/docs/horizon" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Horizon</a>, <a href="https://laravel.com/docs/sanctum" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Sanctum</a>, <a href="https://laravel.com/docs/telescope" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Telescope</a>, and more.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div> -->
    <!-- <header class="blog-landing-main-header">
        <section class="blog-landing-head-section">
            <div class="container">
                <div class="blog-landing-menu-holder">
                    <div class="blog-landing-nav-logo-holder">
                        <div class="logo-image-holder">
                            <img src="{{url('/images/logo.jpg')}}" alt="BootstrapBrain Logo">
                        </div>
                    </div>
                    <div class="blog-landing-nav-menu-holder">
                        
                        <ul class="blog-landing-list">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Careers</a></li>
                            
                            <li><a href="{{ route('register-page') }}">Login/Register</a></li>
                            
                        </ul>
                    </div>
                    
                </div>
            </div>
        </section>
    </header> -->
    <!-- <header class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="{{url('/images/logo.jpg')}}" alt="Company Logo">
                </div>
                <nav class="main-nav">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="{{ route('register-page') }}">Login/Register</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header> -->
    <main>
        <section class="hero-header">
            <div class="container">
                <!-- Header -->
                <div class="header-content">
                    <div class="logo">
                        <img src="{{url('/images/logo.jpg')}}" alt="Company Logo">
                    </div>
                    <nav class="main-nav">
                        <ul>
                            <li><a href="{{ route('register-page') }}">Employee Signup</a></li>
                            <li><a href="{{ route('hr-register-page') }}">Employer Signup</a></li>
                            <li><a href="{{ route('login-page') }}">Employee Login</a></li>
                            <li><a href="{{ route('hr-login-page') }}" class="login-cta">Employer Login</a></li>

                        </ul>

                    </nav>
                </div>

                <!-- Hero Content -->
                <div class="row align-items-center hero-content">
                    <div class="col-md-6">
                        <div class="banner-image-holder">
                            <img src="{{url('/images/job.png')}}" alt="Employee Verification">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-wrapper">
                            <h1>“Verify Employees.<span class="highlight"> Build Trust.</span> Reduce Risks.”</h1>
                            <h4>Fast, Reliable & Automated Employee Verification.</h4>
                            <div class="button-group">
                                <a href="{{ route('hr-register-page') }}" class="primary-btn">Start Verifying Now</a>
                                <a href="https://www.youtube.com/@eimagerOfficial" target="_blank" class="secondary-btn">Get a Demo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <section class="blog-banner-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="banner-image-holder">
                            <img src="{{url('/images/job.jpg')}}" alt="BootstrapBrain Logo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="content-wrapper">
                            <h1>“Verify Employees.<span class="styled-sup"> Build Trust.</span> Reduce Risks.”</h1>
                            <h4>Fast, Reliable & Automated Employee Verification.</h4>
                            <a href="#" class="learn-more">
                                Start Verifying Now
                            </a>
                            <a href="#" class="free-demo">
                                Get a Demo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <section class="company-badches">
            <div class="badch-wrapper">
                <h2>Trust Badges</h2>
                <div class="trust-badges">
                    <div class="badge-wrapper">
                        <img src="{{url('/images/iso-one.png')}}" alt="ISO Certified">
                    </div>
                    <div class="badge-wrapper">
                        <img src="{{url('/images/iso-two.png')}}" alt="ISO Certified">
                    </div>
                    <div class="badge-wrapper">
                        <img src="{{url('/images/gdpr-image.png')}}" alt="GDPR Compliant">
                    </div>
                    <div class="badge-wrapper">
                        <img src="{{url('/images/soc.png')}}" alt="Secure and complaint">
                    </div>

                </div>
            </div>
        </section>
        <section class="services-section">
            <div class="container">
                <div class="service-header">
                    <!-- <h2>Why Choose Eimager? </h2> -->
                    <h2 id="typewriter-text"></h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="service-card-wrapper">
                            <div class="service-content">
                                <div class="heading-wrapper">
                                    <h4>Employer Verification :</h4>
                                </div>

                                <p> 90% percent of the companies can’t do employee verification due to lack of technology, lack of funds, staff and lengthy process and duration.
                                    When Companies/Startups/SME hire unverified employees and give access to the data of :- Clients, Management, Team, Projects, Assets From 15 to 45 Days, If They Have Verification Process and terminate them after 15 to 45 if found faulty
                                    And Think About if your Employee Joins without verification, What Will be the result ?
                                </p>
                                <div class="step-container">
                                    <ul class="step-list">
                                        <li>Higher Verified Employee Within a Min Verification Process</li>
                                        <li>Secured Client, Management, Team, Projects, Assets</li>
                                        <li>100% Automated Process and 0% Error Rates</li>
                                        <li>Two Way Verification/Review (At time of joining and separation)</li>
                                        <li>Dedicated Verification Manager</li>
                                        <li>24x7 Support (Live Chat, Email, Phone)</li>
                                        <li>Highly Customized Management Information System (MIS)</li>
                                        <li>100% Authentic Data & Process</li>
                                        <li>Minimize Employees & Employers Dispute</li>
                                        <li>Smooth Separation Process & Settlement</li>
                                        <li>Reduction In Legal Cases Due To Joining And Exit Online Tracking Process</li>
                                        <li>0% Chances Of Fake Data & Documents - Letter, Experience Certificates, Pay Slip, NOC, etc.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="service-card-wrapper">
                            <div class="service-content">
                                <div class="heading-wrapper">
                                    <h4>Why Employee Should Register :</h4>
                                </div>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
                                </p>
                                <div class="step-container">
                                    <ul class="step-list">
                                        <li>Employee Registered and Verified Himself</li>
                                        <li>Secure Career For Employee</li>
                                        <li>0% Error Rates In Verification Process</li>
                                        <li>Built His Trust With Employers/Companies/MNCs</li>
                                        <li>100% Secured Data</li>
                                        <li>100% Verified Employer</li>
                                        <li>Global Employer Reach</li>
                                        <li>Vast Database</li>
                                        <li>Minimize Employees & Employers Dispute</li>
                                        <li>Smooth Separation Process & Settlement</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- <div class="all-services">
                    <a href="#">View All</a>
                </div> -->
            </div>
        </section>
        <section class="why-take-risk">
            <div class="container">
                <div class="why-take-risk-wrapper">
                    <h2>Why take risk ?</h2>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="risk-card-wrapper">
                            <div class="icon-holder">
                                <img src="{{url('/images/verify.png')}}">
                            </div>
                            <div class="risk-content">
                                <h2>Comprehensive Verification</h2>
                                <p>Comprehensive Verification ensures accuracy, authenticity, and reliability by thoroughly checking data, documents, or processes. It involves multiple validation steps to detect errors, inconsistencies, or fraud, ensuring compliance and trustworthiness.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="risk-card-wrapper">
                            <div class="icon-holder">
                                <img src="{{url('/images/24-7.png')}}">
                            </div>
                            <div class="risk-content">
                                <h2>Real-Time Results 24x7</h2>
                                <p>Real-Time Results 24x7 provide instant updates and continuous monitoring, ensuring timely and accurate information anytime, anywhere.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="risk-card-wrapper">
                            <div class="icon-holder">
                                <img src="{{url('/images/confidential.png')}}">
                            </div>
                            <div class="risk-content">
                                <h2>Secure & Confidential</h2>
                                <p>Secure & Confidential ensures your data is protected with advanced encryption and strict privacy measures. We prioritize security to prevent unauthorized access and safeguard sensitive information. Trust us to keep your data private and secure at all times.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="risk-card-wrapper">
                            <div class="icon-holder">
                                <img src="{{url('/images/friend-request.png')}}">
                            </div>
                            <div class="risk-content">
                                <h2>User-Friendly Interface</h2>
                                <p>User-Friendly Interface offers a seamless and intuitive experience, making navigation effortless for all users. Designed for simplicity and efficiency, it ensures smooth interactions without any complexity. Enjoy a hassle-free experience with a clean and responsive design.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="risk-card-wrapper">
                            <div class="icon-holder">
                                <img src="{{url('/images/network.png')}}">
                            </div>
                            <div class="risk-content">
                                <h2>Global Data Reach</h2>
                                <p>Global Data Reach ensures seamless access to information across borders, connecting users worldwide in real time. Our advanced network delivers accurate and reliable data without geographic limitations. Experience uninterrupted global connectivity with secure and fast data transmission.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="risk-card-wrapper">
                            <div class="icon-holder">
                                <img src="{{url('/images/verified.png')}}">
                            </div>
                            <div class="risk-content">
                                <h2>Verify Data Within 1 min</h2>
                                <p>Verify Data Within 1 Minute with our fast and efficient system, ensuring accuracy in real time. Our advanced technology processes and validates information instantly. Save time and enhance productivity with quick and reliable data verification.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="how-works">
                    <h2>How It Works (Step-by-Step)</h2>
                    <div class="feature-list-wrapper">
                        <ul class="feature-list">
                            <li>100% Verified Employers & Employees</li>
                            <li>Upload Candidate Details</li>
                            <li>Automated AI-Powered Checks</li>
                            <li>Receive Verified Reports</li>
                            <li>Hire with Confidence</li>
                            <li>100% Secured Data</li>
                            <li>0% Error Rates</li>
                            <li>100% Authentic Data & Process</li>
                            <li>24x7 Support (Live Chat, Email, Phone)</li>
                            <li>Global Employer Reach</li>
                            <li>Reduction in Legal Cases Due to Joining and Exit Online Tracking Process</li>
                            <li>0% Chances of Fake Data & Documents - Letter, Experience Certificates, Pay Slip, NOC, etc.</li>
                        </ul>
                    </div>

                </div>
            </div>
        </section>
        <section class="serve-industries">
            <div class="container">
                <div class="industy-content">
                    <h2>Industries We Serve</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/hand-shake.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Corporate Industry</h4>
                                <p>Corporate Verification ensures businesses hire authentic professionals and work with legitimate partners. It minimizes fraud, enhances compliance, and safeguards company reputation. Stay secure with verified credentials! ✅</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/health.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Healthcare Industry</h4>
                                <p>Healthcare Industry Verification ensures medical professionals and institutions meet regulatory standards. It verifies credentials, licenses, and work history to maintain quality care. Protect patients with thorough background checks.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/it.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>IT Industry</h4>
                                <p>IT Industry Verification ensures tech professionals have genuine qualifications and experience. It helps prevent resume fraud, verifies certifications, and enhances cybersecurity compliance. Build a trusted workforce with accurate background checks!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/hand.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Finance Industry</h4>
                                <p>Finance Industry Verification encompasses processes like Know Your Customer (KYC), Customer Due Diligence (CDD), and Enhanced Due Diligence (EDD) to authenticate client identities, mitigate fraud, and ensure compliance with anti-money laundering regulations. These measures are vital for maintaining the integrity and trustworthiness of financial institutions. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/training.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Education Industry</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/banking-system.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Banking Industry</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/insurance.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Insurance Industry</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/worker.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Construction Industry</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/house.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Real State</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/needs.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Retail Lifestyle</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/telecommunication.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Telecommunication</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/flask.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Pharmaceutical</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/hospitality.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Hospitality</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/oil-rig.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Oil & Gas</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/customer-service.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Consumer Services</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/power-plant.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Manufacturing Industries</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/textile.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Textile Industry</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/live-chat.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>BPO Industry</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/recruitment.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Recruitment Agency</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/consumer-behaviour.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Consumer</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/ecommerce.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>E-commerce</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/ecommerce.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>E-commerce</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/maintenance.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Aviation Industry</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="industry-card-wrapper">
                            <div class="industry-image">
                                <img src="{{url('/images/logistics.png')}}">
                            </div>
                            <div class="industry-inner-content">
                                <h4>Logistics Industry</h4>
                                <p>Education Industry Verification ensures the authenticity of academic credentials, maintaining institutional integrity and trust. In the UK, the Higher Education Degree Datacheck (HEDD) serves as the official service for verifying academic degrees and identifying fraudulent institutions. These measures combat the proliferation of diploma mills, which issue illegitimate degrees.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="all-industry-services">
                    <a href="#" class="all-industry">All Industries</a>
                </div>
            </div>
        </section>
        <!-- <section class="testimonial-section">
            <div class="container">
                <div class="testimonial-slider">
                    <div class="testimonial-item">
                        <p class="quote">"This service exceeded my expectations. The process was seamless, and the verification was fast and reliable."</p>
                        <h4 class="author">- John Doe, CEO of XYZ Corp</h4>
                    </div>
                    <div class="testimonial-item">
                        <p class="quote">"Highly professional and trustworthy. The background check process was smooth and efficient."</p>
                        <h4 class="author">- Jane Smith, HR Manager</h4>
                    </div>
                    <div class="testimonial-item">
                        <p class="quote">"A must-have verification service for businesses looking to hire authentic professionals."</p>
                        <h4 class="author">- Michael Lee, Founder of TechCorp</h4>
                    </div>
                </div>
            </div>

        </section> -->
        <section class="contact-section">
            <div class="container">
                <div class="contact-wrapper">
                    <div class="contact-info">
                        <h2>General Enquiry</h2>
                        <p>Feel free to reach out to us for any inquiries or collaborations.</p>
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> 123 Business Street, New York, NY</li>
                            <li><i class="fas fa-envelope"></i> <strong>Email:</strong> contact@company.com</li>
                            <li><i class="fas fa-phone-alt"></i> <strong>Phone:</strong> +1 234 567 8900</li>
                        </ul>
                        <!-- Career Button -->
                        <button id="careerBtn" class="career-button">Career Opportunity</button>
                    </div>
                    <div class="contact-form">
                        <h2>Get in Touch</h2>
                        <form>
                            <div class="form-group">
                                <input type="text" placeholder="Your Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" placeholder="Your Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Contact Number" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Address" required>
                            </div>
                            <div class="form-group">
                                <select required>
                                    <option value="" disabled selected>Select Inquiry Type</option>
                                    <option value="General">General Inquiry</option>
                                    <option value="Support">Support</option>
                                    <option value="Business">Business Inquiry</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" class="contact-submit">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section class="pdge-group-logo">
            <div class="container">
                <div class="pdge-group-logo">
                    <h2>Brands you trust, trust us</h2>
                </div>
                <div class="logo-top-wrapper">
                    <div class="logo-holder">
                        <ul>
                            <li>
                                <div class="logo-image-holder">
                                    <img src="{{url('/images/pdce-new.jpeg')}}">
                                </div>

                            </li>
                            <li>
                                <div class="logo-image-holder">
                                    <img src="{{url('/images/ultimate-new.jpeg')}}">
                                </div>

                            </li>
                            <li>
                                <div class="logo-image-holder">
                                    <img src="{{url('/images/sristech-new.jpeg')}}">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section id="faq" class="faq">
            <div class="container">
                <div class="heading-faq-wrapper">
                    <h2 class="section-title">Frequently Asked Questions</h2>
                </div>

                <div class="faq-container">
                    <div class="faq-item">
                        <button class="faq-question">What services do you offer? <span class="toggle-icon">+</span></button>
                        <div class="faq-answer">orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question">How can I contact support? <span class="toggle-icon">+</span></button>
                        <div class="faq-answer">orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum....</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <section id="testimonials">
            <div class="container">
                <h2 class="section-title">What Our Clients Say</h2>
                <div class="testimonial-slider">
                    <div class="testimonial-item">
                        <p>"Great experience with HR services!"</p>
                        <h4>- John Doe</h4>
                    </div>
                    <div class="testimonial-item">
                        <p>"Excellent support and service quality!"</p>
                        <h4>- Jane Smith</h4>
                    </div>
                    <div class="testimonial-item">
                        <p>"Amazing work, highly recommend!"</p>
                        <h4>- David Wilson</h4>
                    </div>
                </div>
            </div>
        </section> -->

    </main>
    <footer class="footer-blog-landing-wrapper">
        <div class="footer-blog-landing">
            <div class="container">
                <div class="blog-footer-wrapper">
                    <div class="publisher-menu">
                        <h4>Know More</h4>
                        <ul>
                            <li><a href="mailto:info@eimager.com">info@eimager.com</a></li>
                            <li><a href="tel:7290000451">+91 7290000451</a></li>
                            <li><a href="mailto:bd@eimager.com">bd@eimager.com</a></li>
                            <li><a href="tel:7290000453">+91 7290000453</a></li>
                        </ul>
                    </div>
                    <div class="explorate-menu">
                        <h4>Explorate Us</h4>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Enquiry</a></li>
                            <li><a href="#">Careers</a></li>

                        </ul>
                    </div>
                    <div class="headquarter-menu">
                        <h4>Contact us</h4>
                        <ul>
                            <li><span>Support :</span> <a href="mailto:support@eimager.com"> support@eimager.com</a></li>
                            <li><span>More Info:</span> <a href="mailto:info@eimager.com "> info@eimager.com</a></li>
                            <li><span>Kyc :</span> <a href="mailto:kyc@eimager.com"> kyc@eimager.com</a></li>
                            <li><span>Legal Issues :</span> <a href="mailto:legal@eimager.com"> legal@eimager.com</a></li>
                            <li><span>Marketing :</span> <a href="mailto:marketing@eimager.com"> marketing@eimager.com</a></li>
                            <li><span>Business development :</span> <a href="mailto:bd@eimager.com"> bd@eimager.com</a></li>
                            <li><span>Business Collaboration :</span> <a href="mailto:business@eimager.com"> business@eimager.com</a></li>

                            <li><span>Jobs Related Query :</sapn> <a href="mailto:careers@eimager.com"> careers@eimager.com</a></li>
                        </ul>
                    </div>
                    <div class="connections-menu">
                        <h4>Portal</h4>
                        <ul>
                            <li><a href="{{ route('register-page') }}">Employee Signup</a></li>
                            <li><a href="{{ route('hr-register-page') }}">Employer Signup</a></li>
                            <li><a href="{{ route('login-page') }}">Employee Login</a></li>
                            <li><a href="{{ route('hr-login-page') }}">Employeer Login</a></li>

                            <li><a href="{{ route('admin-login') }}">Admin</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="blog-landing-footer-bottom-menu">
            <div class="container">
                <div class="footer-bottom-wrapper">
                    <p>2025 | EIMAGER</p>
                    <div class="social-media-menu">
                        <ul>
                            <li><a href="https://www.facebook.com/EimagerOfficial"><img src="{{url('/images/f-icon.png')}}"></a></li>
                            <li><a href="https://www.instagram.com/eimagerofficial/"><img src="{{url('/images/instra-icon.png')}}"></a></li>
                            <li><a href="https://www.youtube.com/@eimagerOfficial"><img src="{{url('/images/youtube-icon.png')}}"></a></li>
                            <li><a href="https://x.com/EimagerOfficial/"><img src="{{url('/images/twitter-icon-2.png')}}"></a></li>
                            <li><a href="https://www.linkedin.com/company/eimager-official/"><img src="{{url('/images/in-icon.png')}}"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <button id="scrollToTop" class="scroll-to-top">&#8593;</button>
        <a href="https://wa.me/917290000451" target="_blank" id="whatsappButton" class="whatsapp-button">
            <img src="{{url('/images/whatsapp.png')}}" alt="WhatsApp">
        </a>
        <!-- Modal -->
        <!-- <div id="careerModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Apply for Career</h2>
                <form action="#" method="POST">
                    <input type="text" placeholder="Your Name" required>
                    <input type="email" placeholder="Your Email" required>
                    <input type="text" placeholder="Contact Number" required>
                    <input type="text" placeholder="Address" required>
                    <select required>
                        <option value="" disabled selected>Select Inquiry Type</option>
                        <option value="job">Job Application</option>
                        <option value="internship">Internship</option>
                    </select>
                    <textarea placeholder="Your Message" required></textarea>
                    <button type="submit" class="send-message">Send Message</button>
                </form>
            </div>
        </div> -->
        <div id="careerModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Apply for Career</h2>
                <form action="#" method="POST">
                    <input type="text" placeholder="Your Name" required>
                    <input type="email" placeholder="Your Email" required>
                    <input type="text" placeholder="Contact Number" required>
                    <input type="text" placeholder="Current Designation" required>
                    <input type="text" placeholder="Applied Post" required>
                    <input type="text" placeholder="Total Experience (in years)" required>
                    <input type="text" placeholder="Current CTC (in LPA)" required>
                    <input type="text" placeholder="Expected CTC (in LPA)" required>
                    <input type="text" placeholder="Notice Period (in days)" required>
                    <button type="submit" class="send-message">Send Application</button>
                </form>
            </div>
        </div>
        <!-- modal -->
    </footer>

</body>

</html>
<script>
    document.querySelectorAll(".faq-question").forEach((question) => {
        question.addEventListener("click", function() {
            let answer = this.nextElementSibling;
            let icon = this.querySelector(".toggle-icon");

            answer.style.display = answer.style.display === "block" ? "none" : "block";
            icon.textContent = icon.textContent === "+" ? "-" : "+";
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        let items = document.querySelectorAll(".verification-benefits li");

        items.forEach((item, index) => {
            setTimeout(() => {
                item.style.opacity = "1";
                item.style.transform = "translateY(0)";
            }, index * 350); // Adjust timing as needed
        });
    });


    const text = "Why Choose Eimager?";
    let index = 0;

    function typeWriter() {
        if (index < text.length) {
            document.getElementById("typewriter-text").innerHTML += text.charAt(index);
            index++;
            setTimeout(typeWriter, 100); // Adjust speed
        } else {
            setTimeout(() => {
                document.getElementById("typewriter-text").innerHTML = ""; // Clear text
                index = 0;
                typeWriter(); // Restart animation
            }, 3000); // Wait 1s before restarting
        }
    }

    typeWriter(); // Start animation

    document.addEventListener("DOMContentLoaded", function() {
        var scrollToTopBtn = document.getElementById("scrollToTop");

        window.addEventListener("scroll", function() {
            if (window.scrollY > window.innerHeight / 2) {
                scrollToTopBtn.style.display = "flex";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        });

        scrollToTopBtn.addEventListener("click", function() {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        var whatsappButton = document.getElementById("whatsappButton");

        window.addEventListener("scroll", function() {
            if (window.scrollY > window.innerHeight / 2) {
                whatsappButton.style.display = "flex";
            } else {
                whatsappButton.style.display = "none";
            }
        });
    });

    
    document.addEventListener("DOMContentLoaded", function() {
        var modal = document.getElementById("careerModal");
        var btn = document.getElementById("careerBtn");
        var close = document.querySelector(".close");
        var body = document.body;

        // Ensure modal is hidden initially
        modal.style.display = "none";

        // Open modal on button click
        btn.addEventListener("click", function() {
            modal.style.display = "flex";
            body.style.overflow = "hidden"; // Disable body scrolling
        });

        // Close modal on close button click
        close.addEventListener("click", function() {
            modal.style.display = "none";
            body.style.overflow = ""; // Enable body scrolling
        });

        // Close modal when clicking outside the modal content
        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
                body.style.overflow = ""; // Enable body scrolling
            }
        });
    });

    // modal script
</script>