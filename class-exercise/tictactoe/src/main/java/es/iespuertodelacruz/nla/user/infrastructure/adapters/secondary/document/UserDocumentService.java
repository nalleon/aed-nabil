package es.iespuertodelacruz.nla.user.infrastructure.adapters.secondary.document;

import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.domain.port.secondary.IUserRepository;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;

/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
//@Service
public class UserDocumentService implements IUserRepository {
    @Autowired
    private IUserDocumentRepository repository;

    @Override
    @Transactional
    public User save(User user) {
        if(user == null){
            return null;
        }

        UserDocument dbItem = repository.findUserByName(user.getName());

        if(dbItem != null){
            return null;
        }

        try {
            UserDocument document = IUserDocumentMapper.INSTANCE.toDocument(user);
            UserDocument savedEntity = repository.save(document);
            return IUserDocumentMapper.INSTANCE.toDomain(savedEntity);
        } catch (RuntimeException e){
            throw new RuntimeException("Invalid data");
        }
    }

    @Override
    public List<User> findAll() {
        List<UserDocument> documentList = repository.findAll();
        return IUserDocumentMapper.INSTANCE.toDomainList(documentList);
    }

    @Override
    public User findById(Integer id) {
        UserDocument documentFound = repository.findById(id.toString()).orElse(null);

        if (documentFound != null){
            return IUserDocumentMapper.INSTANCE.toDomain(documentFound);
        }
        return  null;
    }

    @Override
    public User findByUserame(String username) {
        UserDocument documentFound = repository.findUserByName(username);

        if (documentFound != null){
            return IUserDocumentMapper.INSTANCE.toDomain(documentFound);
        }
        return null;
    }

    @Override
    public User findByEmail(String email) {
        UserDocument documentFound = repository.findUserByEmail(email);

        if (documentFound != null){
            return IUserDocumentMapper.INSTANCE.toDomain(documentFound);
        }
        return null;
    }

    @Override
    @Transactional
    public boolean delete(Integer id) {
        int quantity = repository.deleteUserById(id.toString());
        return quantity > 0;
    }

    @Override
    @Transactional
    public User update(User user) {
        if(user == null ){
            return null;
        }

        UserDocument dbItem = repository.findUserByName(user.getName());
        if (dbItem == null){
            return null;
        }

        try {
            dbItem.setPassword(user.getPassword());
            dbItem.setEmail(user.getEmail());
            return IUserDocumentMapper.INSTANCE.toDomain(dbItem);
        }  catch (RuntimeException e){
            throw new RuntimeException("Invalid data");
        }

    }
}
