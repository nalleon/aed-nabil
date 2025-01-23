import axios from 'axios';
import React, { useContext, useEffect, useState } from 'react'
import { Link } from 'react-router-dom';
import '../Styles/MoviesPerCategory.css';
import CreateCategory from './CreateCategory';
import { AppThemeContext } from './Context/AppThemeContextProvider';


/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

type Props = {}

/**
 * Type definition for the category
 */
type CategoryType = {
    id: number;
    name: string;
    description: string;
}

/**
 * Type definition for the movie
 */
type MovieType = {
    id: string;
    title: string;
    actor: string;
    director: string;
    genre: string;
    year: number;
    description: string;
    image: string;
    trailer: string;
    categories: number[];
};

const MoviesPerCategory = (props: Props) => {
    /**
     * UseStates
     */
    const [categories, setCategories] = useState<CategoryType[]>([]);
    const [movies, setMovies] = useState<MovieType[]>([]);
    const [filteredMovies, setFilteredMovies] = useState<MovieType[]>([]);
    const [selectedCategory, setSelectedCategory] = useState<number | null>(null);
    const [confirmation, setConfirmation] = useState<boolean>(false);

    /**
     * Other properties
     */
    const url = 'http://localhost:3000/';
    const context = useContext(AppThemeContext);

    /**
     * UseEffect for fetching movies and categories
     */
    useEffect(() => {
        fetchCategories();
        fetchMovies();    
    }, [selectedCategory, filteredMovies])
    
    /**
     * Function to fetch categories from the api
     */
    const fetchCategories = async () => {
        try {
            const response = await axios.get(url+'categories');
            setCategories(response.data);
        } catch (error) {
            console.error('Error fetching categories:', error);
        }
    }

    /**
     * Function to fetch movies from the API
     */
    const fetchMovies = async () => {
        try {
            const response = await axios.get(url + 'movies');
            setMovies(response.data);
        } catch (error) {
            console.error('Error fetching movies:', error);
        }
    };

    /**
     * Function to handle the click of a cetegory
     * @param categoryId 
     */

    const handleCategoryClick = (categoryId: number) => {
        setSelectedCategory(categoryId);

        let filteredMoviesAux: MovieType[] = [];
        
        for (let i = 0; i < movies.length; i++) {
            for (let j = 0; j < movies[i].categories.length; j++) {
                if (movies[i].categories[j] == categoryId) {
                    filteredMoviesAux.push(movies[i]);
                }
            }
        }

        setFilteredMovies(filteredMoviesAux); 
    };

    return (
        <>
            <div className="container" style={{minHeight:'100vh'}}>
                <div className="justify-content-center align-items-center">
                    <h2 className="text-center text-uppercase fw-bold title">Categories</h2>
                    <h6 className="text-center text-uppercase fw-bold title mt-5 mb-3">
                        <span onClick={()=> setConfirmation(!confirmation)}>Think something is missing? Create a new category</span>
                    </h6>
                    <div className="col-12 d-flex justify-content-center align-items-center mb-4">
                        <button className="btn btn-warning" onClick={() => setConfirmation(!confirmation)}>CREATE</button>
                    </div>
                        {confirmation &&
                            <div className="col-12 d-flex justify-content-center align-items-center mb-3">
                                <CreateCategory />
                            </div>
                        }
                </div>
                <div className="row flex-wrap">
                    <div className="row">
                        {categories.map((category) => (
                            <div className="col-12 col-md-4">
                                <div
                                    key={category.id}
                                    className={`col-4 mt-4 ${context.theme === 'dark' ? 'category-name-custom-card' : 'category-name-custom-card-light'} 
                                                category-name-custom-card${selectedCategory === category.id ? '-selected' : ''} 
                                                `}
                                    onClick={() => handleCategoryClick(category.id)}
                                >
                                    <h5 className='fw-bold text-uppercase'>{category.name}</h5>
                                    <p>{category.description}</p>
                                </div>  
                            </div>

                        ))}
                    </div>
                </div>
                <div className="row mt-5">
                    {filteredMovies.length > 0 && (
                        <div className="row flex-wrap">
                            {filteredMovies.map((movie, index) => (
                            <div key={index} className="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xxl-2 mb-3">
                                <div className={`category-custom-card${context.theme === 'dark' ? '' : '-light'}`}>
                                <Link to={`/movies/${movie.id}`} 
                                        className='link-offset-2 link-underline link-underline-opacity-0'>
                                    {movie.image ? (
                                            movie.image.startsWith("http://") || movie.image.startsWith("https://") ? (
                                            <img
                                                src={movie.image}
                                                alt={movie.title}
                                                className="img-fluid"
                                            />
                                            ) : (
                                            <img
                                                src={url + movie.image}
                                                alt={movie.title}
                                                className="img-fluid"
                                            />
                                            )
                                        ) : (
                                            <img
                                            src={url + 'default,jpg'}  
                                            alt="default"
                                            className="img-fluid"
                                            />
                                        )}
                                    <div className="category-custom-title">
                                        {movie.title}
                                    </div>
                                </Link>
                                </div>
                            </div>
                            ))}
                        </div>
                        )
                    }
                </div>
            </div>
        </>
    )
}

export default MoviesPerCategory