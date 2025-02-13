package es.iespuertodelacruz.nla.shared.config;

import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

@Configuration
@EnableWebSecurity
public class SecurityConfig {

//    @Autowired private JwtFilter jwtAuthFilter;
//
//    @Bean
//    public PasswordEncoder passwordEncoder() {
//        return new BCryptPasswordEncoder();
//    }
//
//    @Bean
//    public SecurityFilterChain securityFilterChain(HttpSecurity http) throws Exception {
//        http
//                .cors(AbstractHttpConfigurer::disable)
//                .csrf(AbstractHttpConfigurer::disable)
//                .authorizeHttpRequests(auth -> auth
//                        .requestMatchers(HttpMethod.OPTIONS, "/**").permitAll()
//                        .requestMatchers(
//                                "/", "/swagger-ui.html",
//                                "/swagger-ui/**", "/v2/**", "/v3/**",
//                                "/configuration/**","/swagger*/**",
//                                "/webjars/**", "/api/v1/auth/**",
//                                "/websocket*/**", "/index.html",
//                                "/services/**"
//                        ).permitAll()
//                        .requestMatchers("/api/v3/**").hasRole("ADMIN")
//                        .anyRequest().authenticated()
//                )
//                .sessionManagement(sess -> sess.sessionCreationPolicy(SessionCreationPolicy.STATELESS))
//                .addFilterBefore(jwtAuthFilter, UsernamePasswordAuthenticationFilter.class);
//
//        return http.getOrBuild();
//    }
}
