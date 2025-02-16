package es.iespuertodelacruz.nla.game.infrastructure.adapters.primary.dto;

import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.infrastructure.adapters.primary.dto.UserJoinDTO;

import java.io.Serializable;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
public record GameDTO(
        String player1,
        String player2,
        char[][] board,
        boolean finished
) implements Serializable {

}
