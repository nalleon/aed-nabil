package es.iespuertodelacruz.nla.game.domain.service;

import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.game.domain.port.primary.IGameService;
import es.iespuertodelacruz.nla.game.domain.port.secondary.IGameRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class GameService implements IGameService {
    @Autowired
    IGameRepository repository;

    @Override
    public Game add(String name, String email, String password) {
        Game aux = new Game(name, password, email);
        return repository.save(aux);
    }

    @Override
    public Game findById(Integer id) {
        return repository.findById(id);
    }

    @Override
    public List<Game> findAll() {
        return repository.findAll();
    }

    @Override
    public boolean delete(Integer id) {
        return repository.delete(id);
    }

    @Override
    public Game update(String name, String email, String password) {
        Game aux = new Game(name, password, email);
        return repository.update(aux);
    }
}
