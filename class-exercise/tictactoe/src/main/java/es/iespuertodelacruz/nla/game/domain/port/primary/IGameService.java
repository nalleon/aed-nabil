package es.iespuertodelacruz.nla.game.domain.port.primary;

import es.iespuertodelacruz.nla.game.domain.Game;

import java.util.List;

public interface IGameService {
    Game add(String name, String email, String password);
    Game findById(Integer id);
    List<Game> findAll();
    boolean delete(Integer id);
    Game update(String name, String email, String password);

}
