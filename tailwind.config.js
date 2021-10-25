module.exports = {
    purge: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: "media", // or 'media' or 'class'
    theme: {
        screens: {
            sm: "640px",
            md: "768px",
            lg: "1024px",
            xl: "1280px",
        },
        container: {
            center: true,
        },
        extend: {
            fontFamily: {
                sans: '"Exo 2", Inter UI, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Fira Sans, Droid Sans, Helvetica Neue',
                mono: '"Fira Code", Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;',
            },
            typography: {
                DEFAULT: {
                    css: {
                        color: "#bcc6d2",
                        h1: {
                            color: "#FFF",
                        },
                        h2: {
                            color: "#FFF",
                        },
                        h3: {
                            color: "#FFF",
                        },
                        a: {
                            color: "#FFF",
                            "&:hover": {
                                color: "#fa7369",
                            },
                        },
                    },
                },
                xl: {
                    css: {
                        h1: {
                            fontSize: "3rem",
                        },
                        h2: {
                            fontSize: "1.75rem",
                            letterSpacing: "-0.5px",
                            marginBottom: "0.3em",
                        },
                        h3: {
                            fontSize: "1.5rem",
                            letterSpacing: "-0.5px",
                            marginBottom: "0.3em",
                        },
                    },
                },
            },
        },
    },
    variants: {
        extend: {},
    },
    plugins: [require("@tailwindcss/typography")],
};
