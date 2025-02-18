package es.iespuertodelacruz.nla.game.infrastructure.adapters.primary.dto;

import java.io.Serializable;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
public record GameListDTO(
        int id,
        String player1,
        String player2,
        char[][] board,
        boolean finished,
        String turnPlayer
) implements Serializable {

}
