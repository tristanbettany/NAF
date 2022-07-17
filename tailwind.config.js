const colors = require('tailwindcss/colors')

let Spacing = 1;

let SpacingObject = {};
for (i = 0; i < 100; i++) {
    SpacingObject[Spacing + 'px'] = Spacing + 'px';
    SpacingObject[Spacing + '%'] = Spacing + '%';
    Spacing += 1;
}

Spacing = 1;
let HeightObject = {};
for (i = 0; i < 500; i++) {
    HeightObject[Spacing + 'px'] = Spacing + 'px';
    HeightObject[Spacing + '%'] = Spacing + '%';
    HeightObject[Spacing + 'vh'] = Spacing + 'vh';
    Spacing += 1;
}

Spacing = 2;
let FontSizeObject = {};
for (i = 0; i < 200; i++) {
    FontSizeObject[Spacing + 'px'] = Spacing + 'px';
    Spacing += 2;
}

Spacing = 1;
let WidthObject = {};
for (i = 0; i < 20; i++) {
    WidthObject[Spacing + 'px'] = Spacing + 'px';
    Spacing += 1;
}

module.exports = {
    content: ["./Presentation/Templates/**/*.{twig,html,cshtml,js,ts,jsx,tsx}"],
    theme: {
        extend: {},
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: '#22292f',
            white: colors.white,
            slate: colors.slate,
            cyan: colors.cyan,
            sky: colors.sky,
            emerald: colors.emerald,
            rose: colors.rose,
            fuchsia: colors.fuchsia,
            amber: colors.amber,
        },
        spacing: SpacingObject,
        height: HeightObject,
        fontSize: FontSizeObject,
        borderWidth: WidthObject,
        ringOffsetWidth: WidthObject,
        ringWidth: WidthObject,
        strokeWidth: WidthObject,
        textDecorationThickness: WidthObject,
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
