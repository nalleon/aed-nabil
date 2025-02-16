package es.iespuertodelacruz.nla.game.domain.port.primary;

import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.user.domain.User;

import java.util.List;

public interface IGameService {
    Game add(User player1);
    Game findById(Integer id);
    List<Game> findAll();
    boolean delete(Integer id);
    Game update(int id, User play1, User player2, char[][] board, boolean finished);
    Game findOpenGame();
    Game joinGame(int id, User player2);

    Game play(int id, String playername, int posX, int posY);
}
