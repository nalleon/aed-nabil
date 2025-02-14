package es.iespuertodelacruz.nla.game.infrastructure.adapters.primary.dto;

import es.iespuertodelacruz.nla.user.domain.User;

import java.io.Serializable;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
public record GameDTO(
        User player1,
        User player2,
        char[][] board,
        boolean finished
) implements Serializable {

}
