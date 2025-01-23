import axios from 'axios';
import React, { useContext, useEffect, useState } from 'react'
import ReactPlayer from 'react-player';
import { Link, useNavigate, useParams } from 'react-router-dom'
import '../Styles/MovieDetails.css';
import DeleteMovie from './DeleteMovie';
import { FavouriteMoviesContext } from './Context/FavouriteMoviesContextProvider';
import BackButton from './BackButton';
import { AppThemeContext } from './Context/AppThemeContextProvider';

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */


type Props = {}

interface MovieType {
  id: number;
  titulo: string;
  year: string;
  direccion: DireccionActores[];
  actores: DireccionActores[];
  categorias: Categoria[];
  descripcion: string;
  caratula: string;
  trailer: string;
}

interface Categoria {
  id: number;
  nombre: string;
}

interface DireccionActores {
  id: number;
  nombre: string;
  apellidos: string;
}


const MovieDetails = (props: Props) => {
  /**
   * UseParam
   */
  const { movieId } = useParams();
  /**
   * UseStates
   */
  const [data, setData] = useState<MovieType>({} as MovieType);
  const [showConfirmation, setShowConfirmation] = useState(false);

  /**
   * Context and useState for favourites / user's favorites and context for theme
   */
  const context = useContext(FavouriteMoviesContext);
  const [isFavourite, setIsFavourite] = useState<boolean>(() => 
    {
      if (movieId != null) {
        const isFav = context.favourites.some((favourite) => favourite == parseInt(movieId));
        return isFav ? true : false;
      }
      return false; 
    }
  );

    const contextTheme = useContext(AppThemeContext);
  
  /**
   * Other properties
   */
  const uri: string = "http://localhost:8088/api/"




  /**
   * UseEfect 
   */

  useEffect(() => {
    fetchMovie();
  }, [movieId, context.favourites]);



  /**
   * Function to fetch the movie from the api
   */
  const fetchMovie = async () => {
    try {
      const response = await axios.get(`${uri}movies/${movieId}`);
      setData(response.data.data);
    } catch (error) {
      console.error("Error fetching the movie:", error);
    }
  };

  /**
   * Function to handle the favourite add/remove 
   */
  const handleAddFavourite = () => {
    const added = context.addFavourite(data.id);
    setIsFavourite(true);

    if (!added){
      context.removeFavourite(data.id);
      setIsFavourite(false);
      return;
    }

  }

  return (
    <>
      <div className="container py-5 " style={{minHeight:'100vh'}}>
        <div className={`row align-items-center custom-bg${contextTheme.theme === 'dark' ? '' : '-light'}`}>
          <div className="col-12 align-items-start mb-2">
            <BackButton/>
          </div>
          <div className="col-sm-12 col-md-6 ">
            {data.caratula ? (
                data.caratula.startsWith("http://") || data.caratula.startsWith("https://") ? (
                  <img
                    src={data.caratula}
                    alt={data.titulo}
                    className="img-fluid"
                  />
                ) : (
                  <img
                    src={uri + data.caratula}
                    alt={data.titulo}
                    className="img-fluid img-custom"
                  />
                )
              ) : (
                <img
                  src={uri + 'default.jpg'}  
                  alt="default"
                  className="img-fluid"
                />
              )}
          </div>

            
          <div className="col-sm-12 col-md-6">
            <div className={`card card-custom${contextTheme.theme === 'dark' ? '' : '-light'} mt-3`}>
              <h3 className="display-5 text-uppercase mb-4 fw-bold">{data.titulo}</h3>
              <ul className="list-unstyled mb-4">
                <li className="mb-3">
                  <strong>Actors:</strong>
                    <ul>
                      {data.actores && data.actores.length > 0 ? data.actores.map((actor)=> (
                          <li>{actor.nombre} {actor.apellidos} </li>
                        )) :
                        <li>No data available.</li>
                      } 
                    </ul>
                </li>
                <li className="mb-3">
                  <strong>Director:</strong> 
                    <ul>
                      {data.direccion && data.direccion.length > 0 ? data.direccion.map((direccion)=> (
                          <li>{direccion.nombre} {direccion.apellidos} </li>
                        )) :
                        <li>No data available.</li>
                      } 
                    </ul>
                </li>
                <li className="mb-3">
                  <strong>Categoria:</strong> 
                  <ul>
                      {data.categorias && data.categorias.length > 0 ? data.categorias.map((categoria)=> (
                          <li>{categoria.nombre} </li>
                        )) :
                        <li>No data available.</li>
                      } 
                  </ul>
                </li>
                <li className="mb-3">
                  <strong>Release date:</strong> {data.year}
                </li>
              </ul>

              <div className={`description${contextTheme.theme === 'dark' ? '' : '-light'} mb-4`}>
                <p className="text-justify">{data.descripcion}</p>
              </div>

              <div className="trailer">
                <div>
                  <h5 className="mb-3">Watch Trailer</h5>
                  <ReactPlayer
                    url={data.trailer}
                    controls
                    width="100%"
                    height="300px"
                    className="trailer2 rounded shadow-lg"
                  />
                </div>
              </div>
              <div className="row mt-3">
                <div className="col-12 d-flex justify-content-center align-items-center">
                  <button className={`custom-button${isFavourite === true ? '-fav' : ''}${contextTheme.theme === 'dark' ? '' : '-light'}`} onClick={handleAddFavourite}>  
                    <i className={`bi bi-star${isFavourite === true ? '-fill' : ''}`}></i>
                  </button> 
                </div>
              </div>
            </div>
          </div>
          <div className="row mt-5 ms-5 me-5">
            <div className="col-12 col-md-6">
              <Link to={`/movies/modify/${data.id}`} className="btn btn-primary w-75 mb-3">
                Edit
              </Link>               
            </div>
            <div className="col-12 col-md-6">
              <button className="btn btn-danger w-75" onClick={() => setShowConfirmation(true)}>
                  Delete
              </button>
            </div>
          </div>
        </div>
        <div className='d-flex justify-content-center align-items-center mt-3'>
            {showConfirmation && (
              <DeleteMovie movieId={movieId} onCancel={() => setShowConfirmation(false)}/>
          )}
        </div>
    
      </div>
    </>
  )
}

export default MovieDetails