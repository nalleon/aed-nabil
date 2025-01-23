import React, { useContext } from 'react'
import AppThemeContextProvider, { AppThemeContext } from './Context/AppThemeContextProvider';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

type Props = {}

const ThemeSwitcher = (props: Props) => {
    /**
     * Context for the theme
     */
    const context = useContext(AppThemeContext);
    return (
        <button
            onClick={context.toggleTheme}
            className={`btn ${
                context.theme === "dark" ? "btn-dark-theme" : "btn-light-theme"}`}
            aria-label={`Switch to ${context.theme === "dark" ? "light" : "dark"} theme`}
        >
            <i
                className={`bi ${context.theme === "dark" ? "bi-toggle-on" : "bi-toggle-off"}`}
                style={{ marginRight: "8px" }}
            />

            <i className={`bi ${context.theme === "dark" ? "bi-moon-fill" : "bi-sun-fill"}`}></i>
        </button>
    );

}

export default ThemeSwitcher