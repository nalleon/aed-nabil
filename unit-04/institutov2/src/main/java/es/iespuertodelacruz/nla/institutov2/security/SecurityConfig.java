package es.iespuertodelacruz.nla.institutov2.security;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.http.HttpMethod;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.config.http.SessionCreationPolicy;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.security.web.SecurityFilterChain;
import org.springframework.security.web.authentication.UsernamePasswordAuthenticationFilter;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

@Configuration
@EnableWebSecurity
public class SecurityConfig {



    @Autowired	private JwtFilter jwtAuthFilter;

    @Bean
    public PasswordEncoder passwordEncoder() {
        return new BCryptPasswordEncoder();
    }

    @Bean
    public SecurityFilterChain securityFilterChain(HttpSecurity http) throws Exception {

        http
                .cors(cors->cors.disable())
                .csrf(csrf -> csrf.disable() )
                .authorizeHttpRequests(auth -> auth
                        .requestMatchers(HttpMethod.OPTIONS, "/**").permitAll()


                        .requestMatchers(
                                "/", "/swagger-ui.html",
                                "/swagger-ui/**", "/v2/**",
                                "/configuration/**",	"/swagger*/**",
                                "/webjars/**", "/instituto/api/login",
                                "/instituto/api/register", "/v3/**",
                                "/websocket*/**", "/index.html", "/instituto/api/v1/asignaturas",
                                "/instituto/api/confirmation/**"
                        ).permitAll()

                        .requestMatchers("/instituto/api/v2/**").hasAnyRole("USER", "ADMIN")
                        .requestMatchers("/instituto/api/v3/**").hasRole("ADMIN")
                        .anyRequest().authenticated()
                )
                .sessionManagement(sess -> sess.sessionCreationPolicy(SessionCreationPolicy.STATELESS))
                .addFilterBefore(jwtAuthFilter, UsernamePasswordAuthenticationFilter.class);

        return http.getOrBuild();
    }
}
