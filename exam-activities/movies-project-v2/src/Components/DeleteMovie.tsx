import axios from 'axios';
import { useNavigate } from 'react-router-dom';
import '../Styles/MovieDetails.css';
import { useContext } from 'react';
import { FavouriteMoviesContext } from './Context/FavouriteMoviesContextProvider';

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

type Props = {
    movieId : string | undefined
    onCancel: () => void;
}

const DeleteMovie = (props: Props) => {
    /**
     * Parent properties
     */
    const { movieId, onCancel } = props;

    /**
     * Other properties
     */
    const navigate = useNavigate();

    /**
     * Context for favorite movies
     */
    const context = useContext(FavouriteMoviesContext);

    /**
     * Function to handle the deleting of a movie
     */
    const handleDelete = async () => {
        const auxId = movieId;
        if (auxId){
            context.removeFavourite(parseInt(auxId));
        }
        
        try {
            const token = localStorage.getItem('authToken');
            await axios.delete(`http://localhost:8088/api/movies/${movieId}`,  
            
                { headers: {
                    Authorization: `Bearer ${token}`,
                }
            });

            console.log('deleted');

            } catch (error) {
            console.error("Error deleting the movie:", error);
        } finally {
            navigate('/movies/');
        }
    };

    return (
        <>
            <div className="card card-custom w-50">
                <h5>Are you sure you want to delete this movie?</h5>
                <div className="d-flex justify-content-around mt-4">
                    <button className="btn btn-danger" onClick={handleDelete}>
                        Yes, Delete
                    </button>
                    <button className="btn btn-secondary" onClick={onCancel}>
                        Cancel
                    </button>
                </div>
            </div>
        </>
    ) 
}

export default DeleteMovie