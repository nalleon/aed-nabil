package es.iespuertodelacruz.nla.shared.utils;

import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.shared.security.JwtService;
import es.iespuertodelacruz.nla.user.domain.User;
import jakarta.servlet.http.HttpServletRequest;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;

import java.util.Map;

import static es.iespuertodelacruz.nla.shared.security.JwtFilter.authHeader;
import static es.iespuertodelacruz.nla.shared.security.JwtFilter.authHeaderTokenPrefix;

public abstract class AuthCheck {
    private JwtService jwtTokenManager;

    /**
     * Setters of the JWT service
     * @param jwtTokenManager of the JWT service
     */
    @Autowired
    public void setJwtTokenManager(JwtService jwtTokenManager) {
        this.jwtTokenManager = jwtTokenManager;
    }

    protected ResponseEntity<ApiResponse<?>> checkSameUserInRequest(HttpServletRequest request, String aux) {
        String header = request.getHeader(authHeader);
        String token = header.substring(authHeaderTokenPrefix.length());
        Map<String, String> mapInfoToken = jwtTokenManager.validateAndGetClaims(token);
        final String username = mapInfoToken.get("username");

        if (!username.equals(aux)){
            return ResponseEntity.status(HttpStatus.FORBIDDEN).body(new ApiResponse<>(403,
                    "Unable to join a game with a different username",
                    null));
        }
        System.out.println(username + ": " + aux);
        return ResponseEntity.ok().build();
    }

    protected ResponseEntity<ApiResponse<?>> checkSameUser(HttpServletRequest request, User aux) {
        String header = request.getHeader(authHeader);
        String token = header.substring(authHeaderTokenPrefix.length());
        Map<String, String> mapInfoToken = jwtTokenManager.validateAndGetClaims(token);
        final String username = mapInfoToken.get("username");

        if (!username.equals(aux.getName())){
            return ResponseEntity.status(HttpStatus.FORBIDDEN).body(new ApiResponse<>(403,
                    "Unable to join a game with a different username",
                    null));
        }
        return ResponseEntity.ok().build();
    }

    protected ResponseEntity<ApiResponse<?>> checkUserInGame(HttpServletRequest request, Game aux) {
        if(aux == null){
            return ResponseEntity.ok(new ApiResponse<>(404,
                    "Game NOT found",
                    null));
        }
        String header = request.getHeader(authHeader);
        String token = header.substring(authHeaderTokenPrefix.length());
        Map<String, String> mapInfoToken = jwtTokenManager.validateAndGetClaims(token);
        final String username = mapInfoToken.get("username");

        if (!username.equals(aux.getPlayer1().getName()) && !username.equals(aux.getPlayer2().getName())){
            return ResponseEntity.status(HttpStatus.FORBIDDEN).body(new ApiResponse<>(403,
                    "Unable to bet in a game you're not a part of",
                    null));
        }
        return ResponseEntity.ok().build();
    }
}
