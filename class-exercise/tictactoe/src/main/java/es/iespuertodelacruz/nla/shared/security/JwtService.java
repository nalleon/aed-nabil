package es.iespuertodelacruz.nla.shared.security;

import java.util.Date;
import java.util.HashMap;
import java.util.Map;

import org.springframework.stereotype.Service;




import com.auth0.jwt.JWT;
import com.auth0.jwt.algorithms.Algorithm;
import com.auth0.jwt.interfaces.Claim;
/**
 * @author Nabil Leon Alvarez <@nalleon>
 */

@Service
public class JwtService {

    //@Value("${jwt.secret}")
    private String secret="readumineko";

    //@Value("${jwt.expiration}")
    private long expiration=9876543210L;

    /**
     * Function to generate a token
     * @param username to add to the claims
     * @param role to add to the claims
     * @return the token created
     */
    public String generateToken(String username, String role) {
        return JWT.create()
                .withSubject(username)
                .withClaim("role", role)
                .withExpiresAt(new Date(System.currentTimeMillis() + expiration))
                .sign(Algorithm.HMAC256(secret));
    }

    /**
     * FUnction to get the claims of a token
     * @param token to get its claims
     * @return a map (string, string) with the claims
     */
    public  Map<String, String> validateAndGetClaims(String token) {
        Map<String, Claim> claims = JWT.require(Algorithm.HMAC256(secret))
                .build()
                .verify(token)
                .getClaims();

        Map<String,String> infoToken = new HashMap<String,String>();
        infoToken.put("username", claims.get("sub").asString());
        infoToken.put("role", claims.get("role").asString());

        return infoToken;
    }
}
