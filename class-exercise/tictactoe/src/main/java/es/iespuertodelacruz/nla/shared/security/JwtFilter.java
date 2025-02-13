package es.iespuertodelacruz.nla.shared.security;
import java.io.IOException;
import java.util.*;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.web.authentication.WebAuthenticationDetailsSource;
import org.springframework.stereotype.Component;
import org.springframework.web.filter.OncePerRequestFilter;

import com.auth0.jwt.exceptions.JWTVerificationException;


import jakarta.servlet.FilterChain;
import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import static java.lang.Integer.parseInt;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

@Component
public class JwtFilter extends OncePerRequestFilter {

    public static final String authHeader="Authorization";
    public static final String authHeaderTokenPrefix="Bearer ";
    @Autowired
    private JwtService jwtTokenManager;
    @Override
    protected void doFilterInternal(HttpServletRequest request, HttpServletResponse response, FilterChain filterChain)
            throws ServletException, IOException {

        //TODO: delete
        if(true){
            filterChain.doFilter(request, response);
            return;
        }

        String path = request.getRequestURI();


        Set<String> rutasPermitidas = Set.of(
                "/swagger-ui.html",
                "/swagger-ui/", "/v2/", "/v3/",
                "/configuration/","/swagger/",
                "/webjars/", "/api/v1/auth/",
                "/websocket/", "/index.html",
                "/services/"
        );

        for (String ruta : rutasPermitidas) {
            if (path.startsWith(ruta)) {
                filterChain.doFilter(request, response);
                return;
            }
        }

        String header = request.getHeader(authHeader);

        if (header != null && header.startsWith(authHeaderTokenPrefix)) {
            String token = header.substring(authHeaderTokenPrefix.length());
            try {
                Map<String, String> mapInfoToken = jwtTokenManager.validateAndGetClaims(token);

                final String username = mapInfoToken.get("username");

                final String role = mapInfoToken.get("role");

                CustomUserDetails userDetails = new CustomUserDetails(username, role);


                UsernamePasswordAuthenticationToken authToken = new UsernamePasswordAuthenticationToken(
                        userDetails,
                        null,
                        userDetails.getAuthorities()
                );

                authToken.setDetails(new WebAuthenticationDetailsSource().buildDetails(request));
                SecurityContextHolder.getContext().setAuthentication(authToken);

                filterChain.doFilter(request, response);

            } catch (JWTVerificationException e) {
                response.setStatus(HttpServletResponse.SC_UNAUTHORIZED);
                return;
            }

        }
    }
}