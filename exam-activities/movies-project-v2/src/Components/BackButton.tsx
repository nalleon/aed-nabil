import { useNavigate } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
const BackButton = () => {
    /**
     * UseNavigate 
     */
    const navigate = useNavigate();

    /**
     * Function to navigate to the last page visited
     */
    const handleBack = () => {
        navigate(-1); 
    };

    return (
        <>
            <button
                className="btn btn-warning d-flex align-items-center"
                onClick={handleBack}
            >
                <i className="bi bi-arrow-left me-2"></i> Back
            </button>
        </>
    );
};

export default BackButton;
