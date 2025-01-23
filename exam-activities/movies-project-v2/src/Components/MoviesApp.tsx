import React, { useContext } from 'react'
import CreateMovie from './CreateMovie';
import UpdateMovie from './UpdateMovie';
import FindMovie from './FindMovie';
import Login from './Login';
import { BrowserRouter, Route, Link, Routes } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import '../Styles/Theme.css';

import ThemeSwitcher from './ThemeSwitcher';
import AppThemeContextProvider, { AppThemeContext } from './Context/AppThemeContextProvider';
import MovieDetails from './MovieDetails';
import FavouriteMoviesContextProvider from './Context/FavouriteMoviesContextProvider';
import FavouritesMovies from './FavouritesMovies';
import AppLoginContextProvider, { UserContext } from './Context/AppLoginContextProvider';
import MoviesPerCategory from './MoviesPerCategory';
import CreateCategory from './CreateCategory';

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

type Props = {}

const MoviesApp = (props: Props) => {
    return (
        <BrowserRouter>
            <AppLoginContextProvider>
                    <AppThemeContextProvider>
                        <FavouriteMoviesContextProvider>
                            <Navbar />
                            <ShowContextButtons/>
                            <Routes>
                                <Route path="/" element={<FindMovie />} />
                                <Route path="/login" element={<Login />} />
                                <Route path="/movies" element={<FindMovie/>}/>
                                <Route path="/movies/create" element={<CreateMovie/>}/>
                                <Route path="/movies/:movieId" element={<MovieDetails/>}/>
                                <Route path="/movies/modify/:movieId" element={<UpdateMovie/>}/>
                                <Route path="/favourites" element={<FavouritesMovies/>}/>
                                <Route path="/movies/categories" element={<MoviesPerCategory/>}/>
                                <Route path="/create-category" element={<CreateCategory/>}/>
                            </Routes>
                            <Footer/>
                        </FavouriteMoviesContextProvider>
                    </AppThemeContextProvider>
            </AppLoginContextProvider>
        </BrowserRouter>
    )

    /**
     * Function to generate the navbar
     * @returns the navbar
     */
    function Navbar() {
        const context = useContext(AppThemeContext);
        return (
            <nav className={`d-flex fixed-top justify-content-center navbar navbar-expand-lg 
                                ${context.theme === 'dark' ? 'navbar-dark-theme' : 'navbar-light-theme'
                            }`}>
                <div className="container-fluid">
                    <h3 className="mt-2 me-2 ms-2">
                        <Link to="/movies" className="link-light link-offset-2 link-underline link-underline-opacity-0 m-3">
                            <i
                                className={`ms-3 bi bi-film me-2 ${
                                    context.theme === 'dark' ? 'icon-dark-theme' : 'icon-light-theme'
                                }`}
                            ></i>
                            <i
                                className={`bi bi-camera-reels-fill ${
                                    context.theme === 'dark' ? 'icon-dark-theme' : 'icon-light-theme'
                                }`}
                            ></i>
                        </Link>
                    </h3>
                    <button className="navbar-toggler" style={{  backgroundColor: 'rgb(223, 164, 62)'}}
                            type="button" data-bs-toggle="collapse" data-bs-target="#navBar" aria-controls="navBar" aria-expanded="true" aria-label="Toggle navigation" >
                        <span className="navbar-toggler-icon"></span>
                    </button>
                        <div id="navBar" className="collapse navbar-collapse">
                            <ul className="d-flex align-items-start navbar-nav me-auto mb-2 mb-lg-0 ms-5">
                                <li className="list-group-item m-1">
                                    <Link to="/movies" className={`link-offset-2 link-underline link-underline-opacity-0 m-3 ${
                                        context.theme === 'dark' ? 'icon-dark-theme' : 'icon-light-theme'
                                    }`}>
                                        Movies 
                                    </Link>
                                </li>
                                <li className="list-group-item m-1">
                                    <Link to="/movies/create/" className={`link-offset-2 link-underline link-underline-opacity-0 m-3 ${
                                        context.theme === 'dark' ? 'icon-dark-theme' : 'icon-light-theme'
                                    }`}>
                                        Create 
                                    </Link>
                                </li>                       
                                <li className="list-group-item m-1">
                                    <Link to="/favourites" className={`link-offset-2 link-underline link-underline-opacity-0 m-3 ${
                                        context.theme === 'dark' ? 'icon-dark-theme' : 'icon-light-theme'
                                    }`}>
                                        Favourites 
                                    </Link>
                                </li>
                                <li className="list-group-item m-1">
                                    <Link to="/movies/categories" className={`link-offset-2 link-underline link-underline-opacity-0 m-3 ${
                                        context.theme === 'dark' ? 'icon-dark-theme' : 'icon-light-theme'
                                    }`}>
                                        Categories 
                                    </Link>
                                </li>
                                <li className="list-group-item m-1">
                                    <Link to="/login" className={`link-offset-2 link-underline link-underline-opacity-0 m-3 ${
                                            context.theme === 'dark' ? 'icon-dark-theme' : 'icon-light-theme'
                                    }`}>
                                        Login/Logout 
                                    </Link>
                                </li>
                            </ul>
                        </div>
                </div>
            </nav>
        );
    }

    /**
     * Function to show the buttons for changing theme and user profile/favourite movies
     * @returns 
     */
    function ShowContextButtons(){
        const context = useContext(UserContext);
        return (
            <nav aria-label="breadcrumb" className="d-flex mt-5 pt-4 justify-content-between breadcrumb-custom">
                <span className='ms-3'></span>
                <div className='row d-inline'>
                    <div className="col-12">
                        { context.user?.username !== ''  &&
                            <Link to={'/favourites'} className='link-secondary link-light-hover link-offset-2 link-underline link-underline-opacity-0 m-3'> 
                                <i className="bi bi-person-circle me-2"></i>{context.user?.username} 
                            </Link>
                        }
                        <ThemeSwitcher />
                    </div>
                </div>
        </nav>
        )
    }

    /**
     * Function to create/show the footer
     * @returns the footer
     */
    function Footer(){
        const context = useContext(AppThemeContext);

        return (
            <footer className={`${context.theme === 'dark' ? 'footer-dark-theme' : 'footer-light-theme'}
                text-center text-light-hover`}>
                <div className="container p-4">
                    <span>Copyright © 2024 - MoviesApp</span>
                </div>
            </footer>
        )
    }

}

export default MoviesApp