package es.iespuertodelacruz.nla.game.domain.service;

import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.game.domain.port.primary.IGameService;
import es.iespuertodelacruz.nla.game.domain.port.secondary.IGameRepository;
import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.domain.port.secondary.IUserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class GameService implements IGameService {
    @Autowired
    IGameRepository repository;

    @Autowired
    IUserRepository userRepository;


    public static final char[][] NEW_BOARD = new char[][]{{' ', ' ', ' '}, {' ', ' ', ' '}, {' ', ' ', ' '}};

    @Override
    public Game add(User player1) {
        Game game = new Game();
        game.setPlayer1(player1);
        game.setCurrentTurn(player1);
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
        Game aux = new Game(player1, player2, board, finished, player1);
        return repository.update(aux);
    }

    @Override
    public Game findOpenGame() {
        return repository.findOpenGame();
    }

    @Override
    public Game joinGame(int id, User player2) {
        Game aux = new Game();
        aux.setId(id);
        aux.setPlayer2(player2);
        return repository.joinGame(aux);
    }

    @Override
    public Game play(int id, String playername, int posX, int posY) {
        Game gameFound = repository.findById(id);

        if(gameFound.getPlayer2() == null){
            return null;
        }

        User userFound = userRepository.findByUserame(playername);

        if(!gameFound.getCurrentTurn().equals(userFound)){
            return null;
        }

        char symbol = 'o';

        if(gameFound.getPlayer1().equals(userFound)){
            symbol = 'x';
        }

        Game afterPlay = repository.play(gameFound, userFound, posX, posY,  symbol);

        if (afterPlay == null){
            return null;
        }

        boolean result = afterPlay.hasLine(afterPlay.getBoard(), posX, posY);

        if (result){
           afterPlay.setFinished(true);
           return repository.update(afterPlay);
        } else {
            return afterPlay;
        }

    }


}
