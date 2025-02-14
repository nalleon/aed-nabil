package es.iespuertodelacruz.nla.game.infrastructure.adapters.secondary.entities;

import es.iespuertodelacruz.nla.game.domain.Game;
import es.iespuertodelacruz.nla.game.domain.port.secondary.IGameRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.Date;
import java.util.List;
import java.util.UUID;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
@Service
public class GameEntityService implements IGameRepository {

    @Autowired
    private IGameEntityRepository repository;

    @Override
    @Transactional
    public Game save(Game game) {
        if(game == null){
            return null;
        }


        try {
            GameEntity entity = IGameEntityMapper.INSTANCE.toEntity(game);
            entity.setCreationDate(new Date());
            entity.setRole("ROLE_USER");
            entity.setVerificationToken(UUID.randomUUID().toString());
            entity.setVerified(0);
            GameEntity savedEntity = repository.save(entity);
            return IGameEntityMapper.INSTANCE.toDomain(savedEntity);
        } catch (RuntimeException e){
            throw new RuntimeException("Invalid data");
        }
    }

    @Override
    public List<Game> findAll() {
        List<GameEntity> listEntities = repository.findAll();
        return IGameEntityMapper.INSTANCE.toDomainList(listEntities);
    }

    @Override
    public Game findById(Integer id) {
        GameEntity entityFound = repository.findById(id).orElse(null);

        if (entityFound != null){
            return IGameEntityMapper.INSTANCE.toDomain(entityFound);
        }
        return  null;
    }


    @Override
    @Transactional
    public boolean delete(Integer id) {
        int quantity = repository.deleteGameById(id);
        return quantity > 0;
    }

    @Override
    @Transactional
    public Game update(Game game) {
        if(game == null ){
            return null;
        }



        try {
//            dbItem.setPassword(game.getPassword());
//            dbItem.setEmail(game.getEmail());
//            return IGameEntityMapper.INSTANCE.toDomain(dbItem);
            return null;
        }  catch (RuntimeException e){
            throw new RuntimeException("Invalid data");
        }

    }
}
