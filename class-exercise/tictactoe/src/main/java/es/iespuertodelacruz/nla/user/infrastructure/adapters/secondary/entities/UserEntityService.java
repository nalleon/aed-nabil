package es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.entities;

import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.domain.port.secondary.IUserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
@Service
public class UserEntityService implements IUserRepository {

    @Autowired
    private IUserEntityRepository repository;

    @Override
    public User save(User user) {
        if(user == null){
            return null;
        }

        UserEntity dbItem = repository.findUserByName(user.getName()).orElse(null);

        if(dbItem != null){
            return null;
        }

        try {
            UserEntity entity = IUserEntityMapper.INSTANCE.toEntity(user);
            UserEntity savedEntity = repository.save(entity);
            return IUserEntityMapper.INSTANCE.toDomain(savedEntity);
        } catch (RuntimeException e){
            throw new RuntimeException("Invalid data");
        }
    }

    @Override
    public List<User> findAll() {
        List<UserEntity> listEntities = repository.findAll();
        return IUserEntityMapper.INSTANCE.toDomainList(listEntities);
    }

    @Override
    public User findById(Integer id) {
        UserEntity entityFound = repository.findById(id).orElse(null);

        if (entityFound != null){
            return IUserEntityMapper.INSTANCE.toDomain(entityFound);
        }
        return  null;
    }

    @Override
    public User findByUserame(String username) {
        UserEntity entityFound = repository.findUserByName(username).orElse(null);

        if (entityFound != null){
            return IUserEntityMapper.INSTANCE.toDomain(entityFound);
        }
        return null;
    }

    @Override
    public User findByEmail(String email) {
        UserEntity entityFound = repository.findUserByEmail(email).orElse(null);

        if (entityFound != null){
            return IUserEntityMapper.INSTANCE.toDomain(entityFound);
        }
        return null;
    }

    @Override
    public boolean delete(Integer id) {
        int quantity = repository.deleteUserById(id);
        return quantity > 0;
    }

    @Override
    public boolean update(User user) {
        if(user == null ){
            return false;
        }

        UserEntity dbItem = repository.findById(user.getId()).orElse(null);
        if (dbItem == null){
            return false;
        }

        try {
            dbItem.setPassword(user.getPassword());
            dbItem.setEmail(user.getEmail());
            return true;
        }  catch (RuntimeException e){
            throw new RuntimeException("Invalid data");
        }

    }
}
