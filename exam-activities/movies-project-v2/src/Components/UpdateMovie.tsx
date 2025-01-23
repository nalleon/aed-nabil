import axios from 'axios';
import React, { useContext, useEffect, useState } from 'react'
import { useNavigate, useParams } from 'react-router-dom';
import { FavouriteMoviesContext } from './Context/FavouriteMoviesContextProvider';
import { AppThemeContext } from './Context/AppThemeContextProvider';

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

type Props = {}

/**
 * Type definition for the movie
 */
interface MovieType {
  id : number,
  titulo: string;
  year: string;
  directores: DireccionActores[];
  actores: DireccionActores[];
  categorias: Categoria[];
  descripcion: string;
  caratula: string;
  trailer: string;
}

interface Categoria {
  id : number,
  nombre: string;
}

interface DireccionActores {
  id : number,
  nombre: string;
  apellidos: string;
}

const UpdateMovie = (props: Props) => {

  /**
   * UseParams
   */
  const { movieId } = useParams();

  /**
   * UseStates
   */
  const [movie, setMovie] = useState<MovieType>({} as MovieType);

  
  const [allCategories, setAllCategories] = useState<Categoria[]>([]);
  const [allActors, setallActors] = useState<DireccionActores[]>([]);
  const [allDirectors, setallDirectors] =useState<DireccionActores[]>([]);

  const [selectedCategories, setSelectedCategories] = useState<Categoria[]>([]);
  const [selectedActors, setSelectedActors] = useState<DireccionActores[]>([]);
  const [selectedDirectors, setSelectedDirectors] = useState<DireccionActores[]>([]);
  
  
    /**
     * Context for favourtites and theme
     */
    const context = useContext(FavouriteMoviesContext);
    const contextTheme = useContext(AppThemeContext);
  

  /**
   * Other properties
   */
  let navigate = useNavigate();
  const uri: string = `http://localhost:8088/api/movies/${movieId}`;
  
  /**
   * UseEffect for fetching the movie and all categories
   */
  useEffect(() => {
    fetchMovie();

  }, [movieId]);


  /**
     * UseEffect for fetching the categories
     */
    useEffect(() => {
      fetchCategories();
    }, [])
  
    
    /**
     * UseEffect for fetching the actors
     */
    useEffect(() => {
      fetchActors();
    }, [])
  
    
    /**
     * UseEffect for fetching the directors
     */
    useEffect(() => {
      fetchDirectors();
    }, [])
  
  
    /**
     * Function to fetch all categories from the API
     */
    const fetchCategories = async () => {
      try {
        const response = await axios.get('http://localhost:8088/api/categories'); 
        setAllCategories(response.data.data);
      } catch (error) {
        console.error('error:' + error);
      }
  
    };
  
      /**
     * Function to fetch all directors from the API
     */
      const fetchDirectors = async () => {
        try {
          const response = await axios.get('http://localhost:8088/api/directors'); 
          setallDirectors(response.data.data);
        } catch (error) {
          console.error('error:' + error);
        }
    
      };
  
  
    /**
     * Function to fetch all actors from the API
     */
    const fetchActors = async () => {
      try {
        const response = await axios.get('http://localhost:8088/api/actors'); 
        setallActors(response.data.data);
      } catch (error) {
        console.error('error:' + error);
      }
    };


  /**
   * Function to submit the changes in a movie 
   * @param event submit of the form
   */

  const handleSubmit = async (event: any) => {
    event.preventDefault();

    let form = event.currentTarget;
    const id = movieId ? parseInt(movieId) : 0; 
    const title = form.title.value;
    const year = form.year.value;
    const description = form.description.value;
    const image = form.image.value ? form.image.value : 'default.jpg';
    const trailer = form.trailer.value ? form.trailer.value : 'https://youtu.be/_htiXfLqXxU?si=MZp0o1GEhpL5_hkj';

    const updatedMovie: MovieType = {
      id: id,
      titulo: title,
      year: year,
      directores: selectedDirectors,
      actores: selectedActors,
      categorias: selectedCategories,
      descripcion: description? description : 'TBA',
      caratula: image ? image : 'default.jpg',
      trailer: trailer ? trailer : 'https://youtu.be/_htiXfLqXxU?si=MZp0o1GEhpL5_hkj',
    };

    try {
      const token = localStorage.getItem('authToken');
      await axios.put(uri, updatedMovie,
        { headers: {
          Authorization: `Bearer ${token}`,
      }},
    );
      
    } catch (error) {
      console.error("Error updating the movie:", error);
    } finally {
      navigate(`/movies/${movieId}`);
    }

    const checkDeleted = updatedFavouritesContext(id);

    if (checkDeleted){
      context.addFavourite(updatedMovie.id);
    }

  }

  /**
   * Function to update the favourite list when updating the movie
   * @param id of the movie
   * @returns  true if movie was in favorites and successfully removed, false otherwise
   */
  const updatedFavouritesContext = (id : number) => {
    for(let i=0; i<context.favourites.length; i++) {
      if(context.favourites[i] == id){
          context.removeFavourite(id);
          return true;
      }
    }
    return false;
  }

  /**
   * Function to fetch the selected movie to edit from the api
   */
  const fetchMovie = async () => {
    try {
      const response = await axios.get(uri);
      setMovie(response.data.data);
    } catch (error) {
      console.error("Error fetching selected movie:", error);
    }

  } 

/**
   * Function to handle the categories selected changes for a movie
   * @param event 
   */
  const handleCategoryChange = (event: React.ChangeEvent<HTMLSelectElement>) => {
    const selectedValues = getSelectedValues(event.target.selectedOptions);
    //setCategories(selectedValues);

    const selection = allCategories.filter(category =>
      selectedValues.includes(category.id)
    );
    
    setSelectedCategories(selection);
  };

  /**
   * Function to get the selected values
   * @param options of the select input
   * @returns an array with the values of the options
   */
  const getSelectedValues = (options: HTMLCollectionOf<HTMLOptionElement>): number[] => {
    return Array.from(options, option => Number(option.value));
  };


  /**
   * Handle actor and director changes
   */
  const handleActorListChange = (event: React.ChangeEvent<HTMLSelectElement>) => {
    const selectedValues = getSelectedValues(event.target.selectedOptions);
    //setActorList(selectedValues);

    const selection = allActors.filter(actor =>
      selectedValues.includes(actor.id)
    );
    
    setSelectedActors(selection);
  };

  const handleDirectorListChange = (event: React.ChangeEvent<HTMLSelectElement>) => {
    const selectedValues = getSelectedValues(event.target.selectedOptions);
    //setDirectorsList(selectedValues);

    const selection = allActors.filter(director =>
      selectedValues.includes(director.id)
    );
    
    setSelectedDirectors(selection);
  };

  return (
    <>
      
      <div className="container py-5">
      <div className={`card card-custom${contextTheme.theme === 'dark' ? '' : '-light'}`}>
        <form onSubmit={handleSubmit}>
        <div className="row g-3 align-items-center ">
            <div className="col-12">
              <label className={`${contextTheme.theme === 'dark' ? '' : 'label-light'}`}>
                <strong>Title</strong>
              </label>
                <input
                  type="text"
                  name="title"
                  placeholder="Enter the title"
                  className={`custom-input${contextTheme.theme === 'dark' ? '' : '-light'}`}
                  defaultValue={movie.titulo} 
                  required
                />
              </div>
              <div className="col-12 col-md-6">
              <label className={`${contextTheme.theme === 'dark' ? '' : 'label-light'}`}>
                  <strong>Director</strong>
                </label>
                <select
                    name='categories'
                    multiple
                    className={`custom-select${contextTheme.theme === 'dark' ? '' : '-light'}`}
                    onChange={handleDirectorListChange}
                    size={allDirectors.length} 
                  >
                    {allDirectors.map((director) => (

                      selectedActors.includes(director) ? ( 
                        
                        <option key={director.id} value={director.id} selected>
                          {director.nombre} {director.apellidos}
                        </option>
                      ) :
                      (
                        <option key={director.id} value={director.id}>
                          {director.nombre} {director.apellidos}
                        </option>
                      )
                    ))}
                  </select>
              </div>

              <div className="col-12 col-md-6">
              <label className={`${contextTheme.theme === 'dark' ? '' : 'label-light'}`}>
                  <strong>Main actors/actress</strong>
                </label>
                <select
                    name='categories'
                    multiple
                    className={`custom-select${contextTheme.theme === 'dark' ? '' : '-light'}`}
                    onChange={handleActorListChange}
                    size={allActors.length} 
                  >
                    {allActors.map((actor) => (

                      selectedActors.includes(actor) ? ( 
                        
                        <option key={actor.id} value={actor.id} selected>
                          {actor.nombre} {actor.apellidos}
                        </option>
                      ) :
                      (
                        <option key={actor.id} value={actor.id}>
                          {actor.nombre} {actor.apellidos}
                        </option>
                      )
                    ))}
                  </select>

              </div>

              <div className="col-12">
              <label className={`${contextTheme.theme === 'dark' ? '' : 'label-light'}`}>
                  <strong>Year of release</strong>
                </label>
                <input
                  type="number"
                  name="year"
                  placeholder="Enter the year of realease"
                  className={`custom-input${contextTheme.theme === 'dark' ? '' : '-light'}`}
                  defaultValue={movie.year}
                  required
                />
              </div>


              <div className="col-12">
              <label className={`${contextTheme.theme === 'dark' ? '' : 'label-light'}`}>
                  <strong>Categories</strong>
                </label>
                  <select
                    name='categories'
                    multiple
                    className={`custom-select${contextTheme.theme === 'dark' ? '' : '-light'}`}
                    onChange={handleCategoryChange}
                    size={allCategories.length} 
                  >
                    {allCategories.map((category) => (

                      selectedCategories.includes(category) ? ( 
                        
                        <option key={category.id} value={category.id} selected>
                          {category.nombre}
                        </option>
                      ) :
                      (
                        <option key={category.id} value={category.id}>
                          {category.nombre}
                        </option>
                      )
                    ))}
                  </select>
              </div>

              <div className="col-12">
                <label className={`${contextTheme.theme === 'dark' ? '' : 'label-light'}`}>
                  <strong>Description</strong>
                </label>
                <textarea
  
                  name="description"
                  placeholder="Enter a brief description of the movie"
                  rows={4} cols={50}
                  className={`custom-input${contextTheme.theme === 'dark' ? '' : '-light'}`}
                  defaultValue={movie.descripcion}
                  
                  required
                />
              </div>

              <div className="col-12 col-md-6">
              <label className={`${contextTheme.theme === 'dark' ? '' : 'label-light'}`}>
                  <strong>Trailer</strong>
                </label>
                <input
                  type="text"
                  name="trailer"
                  placeholder="Youtube URL"
                  className={`custom-input${contextTheme.theme === 'dark' ? '' : '-light'}`}
                  defaultValue={movie.trailer}
                />
              </div>

              <div className="col-12 col-md-6">
              <label className={`${contextTheme.theme === 'dark' ? '' : 'label-light'}`}>
                  <strong>Poster</strong>
                </label>
                <input
                  type="text"
                  name="image"
                  placeholder="Image URL"
                  className={`custom-input${contextTheme.theme === 'dark' ? '' : '-light'}`}
                  defaultValue={movie.caratula}
                />
              </div>

              <div className='col-12'>
                <button type="submit" className={`custom-button${contextTheme.theme === 'dark' ? '' : '-create-light'} w-100`}>
                    Update
                </button>
            </div>
          </div>
          
        </form>    
        </div>
      </div>
    </>
  )
}

export default UpdateMovie