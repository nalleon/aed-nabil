import React, { FormEvent, useContext, useState } from 'react'
import '../Styles/ImageComponent.css'
import { AppThemeContext } from './Context/AppThemeContextProvider';
import axios from 'axios';

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

type Props = {
    value: string; 
    onChange: (newValue: string) => void; 
}

const ImageComponent = (props: Props) => {

    /**
     * UseState
     */
    const [imageUrl, setImageUrl] = useState(props.value);

    
    /**
     * Context for theme
     */
    const context = useContext(AppThemeContext);
    
    /**
     * Event handler for url image input change
     */
    const handleUrlChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        const url = event.target.value;
        setImageUrl(url);
        props.onChange(url);
    };

    /**
    const uploadFile = async (event: FormEvent<HTMLFormElement>) => {
        event.preventDefault();

        let form = event.currentTarget;
        let file = form.inputfile.files[0]

        if (file) {
            const formData = new FormData();
            formData.append("file", file);
            try {
                await axios.post('http://localhost:8000/api/upload',
                    formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }, 
                }
            );

            } catch (error) {
                console.log("Error while uploading the image: "+error); 
            }
    }*/

    return (
        <>
            <div className="row">
                <div className="col-12 col-md-6 align-content-center">
                    <label className={`${context.theme === 'dark' ? '' : 'label-light'}`}>
                        <strong>Poster</strong>
                    </label>
                        <input
                            type="text"
                            name="image"
                            placeholder="Image URL. Leave blank for default thumbnail"
                            className={`custom-input${context.theme === 'dark' ? '' : '-light'}`}
                            onChange={handleUrlChange}
                        />
                    { 
                        /**<div >
                        <form onSubmit={() => uploadFile}>
                            <label htmlFor="file" >
                                Select file
                            </label>
                            <input id="inputfile" type="file" />
                            <button type="submit">Upload</button>
                        </form>
                        
                        </div>
                        */
                    }

                </div>

                <div className="col-12 col-md-6 mt-4">
                    <div className={`preview-custom-card${context.theme === 'dark' ? '' : '-light'} align-content-center`}>
                        {imageUrl && (imageUrl !== '' && (imageUrl.startsWith('https://') || imageUrl.startsWith('http://'))) ? 
                            <img src={imageUrl} alt="Preview" className={`preview-custom-img${context.theme === 'dark' ? '' : '-light'}`} />
                            : 
                            <h3 className='text-center'>Preview</h3>
                        }

                    </div>
                </div>
            </div>
        </>
    )   
}

export default ImageComponent