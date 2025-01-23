import axios from 'axios';
import React, { useContext, useEffect, useState } from 'react'
import { useNavigate } from 'react-router-dom';
import { AppThemeContext } from './Context/AppThemeContextProvider';

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
type Props = {}

/**
 * Type definition for category
 */

type CategoryType = {
    id: string;
    name: string;
    description: string;
};

const CreateCategory = (props: Props) => {
    /**
     * UseStates
     */
    const [name, setName] = useState('');
    const [description, setDescription] = useState('');
    const [allCategories, setAllCategories] = useState<CategoryType[]>([])

  /**
   * Context for theme
   */
  const context = useContext(AppThemeContext);


    /**
     * Other properties
     */
    const uri: string = "http://localhost:3000/categories";
    let navigate = useNavigate();


    useEffect(() => {
        fetchCategories();
    }, []);

    /**
     * Function to fetch all current categories available
     */
    const fetchCategories = async () => {
        try {
            const response = await axios.get(uri); 
            setAllCategories(response.data);
        } catch (error) {
        console.error('Error fetching categories:', error);
        }
    };

    /**
     * Function to handle de submit of a new category
     * @param event 
     */
    const handleSubmit = async (event : React.FormEvent) => {
        event.preventDefault();

        const id = "" + getNextId(allCategories);
        const newCategory: CategoryType = {
            id,
            name,
            description
        };

        try {
            await axios.post(uri, newCategory);
        } catch (error) {
            console.error("Error creating category:", error);
        } 

        navigate('/movies/categories');
    }


    /**
   * Function to get the next Id for the new Movie
   * @param categories to retrieve the last id at the moment
   * @returns next id 
   */
    const getNextId = (categories : CategoryType[]) => {
        const lastCategory = categories[categories.length - 1];
        const id = parseInt(lastCategory.id.toString()) + 1;
        return id;
    }

    return (
        <>
        <div className="container py-5 " >
        <div className={`card card-custom${context.theme === 'dark' ? '' : '-light'}`}>
        <form onSubmit={handleSubmit}>
        <div className="row g-3 align-items-center ">
              <div className="col-12">
                <label className={`${context.theme === 'dark' ? '' : 'label-light'}`}>
                  <strong>Title</strong>
                </label>
                <input
                  type="text"
                  name="title"
                  placeholder="Enter the category's title"
                  className={`custom-input${context.theme === 'dark' ? '' : '-light'}`}
                  onChange={(e) => setName(e.target.value)}
                  defaultValue={name} 
                  required
                />
                
              </div>

              <div className="col-12">
                <label className={`${context.theme === 'dark' ? '' : 'label-light'}`}>
                  <strong>Description</strong>
                </label>
                <input
                  type="text"
                  name="description"
                  placeholder="Enter a short description about the category"
                  className={`custom-input${context.theme === 'dark' ? '' : '-light'}`}
                  onChange={(e) => setDescription(e.target.value)}
                  defaultValue={description}
                  required
                />
              </div>

              <div className='col-12'>
                <button type="submit" className={`custom-button${context.theme === 'dark' ? '' : '-create-light'} w-100`}>
                Create
                </button>
              </div>

          </div>

        </form>    
        </div>
      </div>
        </>
    )
}

export default CreateCategory