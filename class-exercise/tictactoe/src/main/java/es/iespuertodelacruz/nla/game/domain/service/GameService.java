package es.iespuertodelacruz.nla.game.domain.service;

import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.game.domain.port.primary.IGameService;
import es.iespuertodelacruz.nla.game.domain.port.secondary.IGameRepository;
import es.iespuertodelacruz.nla.user.domain.User;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class GameService implements IGameService {
    @Autowired
    IGameRepository repository;

    public static final char[][] NEW_BOARD = new char[][]{{' ', ' ', ' '}, {' ', ' ', ' '}, {' ', ' ', ' '}};

    @Override
    public Game add(User player1) {
        Game game = new Game();
        game.setPlayer1(player1);
        return repository.save(game);
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
    public Game update(User player1, User player2, char[][] board, boolean finished) {
        Game aux = new Game(player1, player2, board, finished);
        return repository.update(aux);
    }

    @Override
    public Game findOpenGame() {
        return repository.findOpenGame();
    }

    @Override
    public Game joinGame(Game game) {
        return repository.joinGame(game);
    }

}
