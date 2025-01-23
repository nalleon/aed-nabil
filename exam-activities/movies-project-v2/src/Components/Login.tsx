import React, { useState, useContext } from 'react';
import { UserContext } from './Context/AppLoginContextProvider';
import { AppThemeContext } from './Context/AppThemeContextProvider';
import axios from 'axios';


/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

const Login = () => {
  /**
   * UseState
   */
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  /**
   * Context for user/login and theme
   */
  const context = useContext(UserContext);
  const contextTheme = useContext(AppThemeContext);

  const url = `http://localhost:8088/api/login`;

  /**
   * Function to handle the login
   * @param event 
   */
  const handleLogin = async (event: React.FormEvent) => {
    event.preventDefault();
    if (username.trim() && password.trim()) {
      
        try {
          console.log("·");
            const response = await axios.post(url, {
              name: username,
              password: password
            });

            const token = response.data;
            localStorage.setItem('authToken', token);

            console.log("token:"+  token);

            context.login(username);
          } catch (error) {
            console.error("Error login:", error);
          }
      }
  };

  return (
    <>
      <div className="container py-5" style={{minHeight:'100vh'}}>
          {!context.user || context.user.username === 'anonymous' ? (
          <div className={`card card-custom${contextTheme.theme === 'dark' ? '' : '-light'}`}>
              <form onSubmit={handleLogin}>
                <div className="row g-3  d-flex justify-content-center align-items-center">
                  <div className="col-12 col-md-9">
                      <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Enter your username"
                        className={`custom-input${contextTheme.theme === 'dark' ? '' : '-light'}`}
                        value={username}
                        onChange={(e) => setUsername(e.target.value)}
                        required
                      />  
                      <input
                        type="text"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        className={`custom-input${contextTheme.theme === 'dark' ? '' : '-light'} mt-3`}
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                      />
                  </div>
                  <div className="col-12 col-md-3">
                  <button type="submit" className={`custom-button${contextTheme.theme === 'dark' ? '' : '-create-light'} w-100`}>
                      Login
                    </button>
                  </div>
                </div>
              </form>
            </div>
            ) : (
              <div className={`card card-custom${contextTheme.theme === 'dark' ? '' : '-light'}`}>
                <div className="row g-3  d-flex justify-content-center align-items-center">
                  
                  <button  className={`custom-button${contextTheme.theme === 'dark' ? '' : '-create-light'} w-25`} onClick={() => context.logout()}> Logout</button>
                </div>
              </div>
            )
          
          }

        </div>
    </>
  );
};

export default Login;
