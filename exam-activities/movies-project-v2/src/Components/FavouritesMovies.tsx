import React, { useContext, useEffect, useState } from 'react'
import { FavouriteMoviesContext } from './Context/FavouriteMoviesContextProvider';
import { Link } from 'react-router-dom';
import '../Styles/Favourites.css';
import axios, { all } from 'axios';

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

type Props = {}

/**
 * Type definition for the movie
 */
type MovieType = {
    id: number;
    title: string;
    actor: string;
    director: string;
    genre: string;
    year: number;
    description: string;
    image: string;
    trailer: string;
    
}
const FavouritesMovies = (props: Props) => {
    /**
     * UseStates
     */
    const [allMovies, setAllMovies] = useState<MovieType[]>([]);
    const [movies, setMovies] = useState<MovieType[]>([]);

    /**
     * Conext for favourite movies
     */
    const context = useContext(FavouriteMoviesContext);

    /**
     * Other properties
     */
    const url = `http://localhost:3000/`;    


    /**
     * UseEffect to fetch all movies from the api
     */
    useEffect(() => {
        fetchMovies();
    }, []);


    /**
     * UseEffect to filter the movies 
     */
    useEffect(() => {
        filterMovies();
    }, [allMovies, context.favourites]);


    /**
     * Function to fetch all movies from the api
     */
    const fetchMovies = async () => {
        try{
            const response = await axios.get(url+'movies');
            setAllMovies(response.data);
        } catch (error) {
            console.error(error);
        }

    }

    /**
     * Function to filter the movies based on the user's favourites
     */
    const filterMovies = async () => {
        if(allMovies.length <= 0){
            return;
        }

        let filteredMovies: MovieType[] = [];
        for(let i=0; i< allMovies.length; i++){
            if(context.favourites.includes(allMovies[i].id)){
                filteredMovies.push(allMovies[i]);
            }
        }
        
        setMovies(filteredMovies);
    }


    return (
        <>
            <div className="container" style={{minHeight:'100vh'}}>
                    {
                        context.favourites.length > 0 ? (
                        <div className="mt-5">
                            <div className='justify-content-center align-items-center'>
                                <h2 className='text-center text-uppercase fw-bold title'>Favourites Movies</h2>
                                <h2 className='text-center mb-5 text-uppercase fw-bold title'><i className="bi bi-award-fill text-center"></i></h2>   
                            </div>
                            <div className="row g-3 flex-wrap">
                                {movies.map((movie, index) => (
                                <div key={index} className="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xxl-2 mb-3">
                                    <div className="fav-custom-card">
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
                                            <div className="fav-custom-title">
                                                {movie.title}
                                            </div>
                                        </Link>
                                    </div>
                                </div>
                                ))}
                            </div>
                        </div>

                        ) : (
                            <h2 className='text-center text-uppercase fw-bold mb-5'>No favourite movies yet.</h2>
                        )
                    }
            </div>
        </>
    )
}

export default FavouritesMovies