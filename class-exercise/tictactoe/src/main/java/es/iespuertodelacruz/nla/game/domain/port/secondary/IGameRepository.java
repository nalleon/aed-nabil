package es.iespuertodelacruz.nla.game.domain.port.secondary;

import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.user.domain.User;

import java.util.List;

public interface IGameRepository {
    Game save(Game game);
    List<Game> findAll();
    Game findById(Integer id);
    boolean delete(Integer id);
    Game update(Game game);
    Game findOpenGame();
    Game joinGame(Game game);
}
