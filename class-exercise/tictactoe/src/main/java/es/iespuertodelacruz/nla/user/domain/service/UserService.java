package es.iespuertodelacruz.nla.user.domain.service;

import es.iespuertodelacruz.nla.user.domain.User;
import es.iespuertodelacruz.nla.user.domain.port.primary.IUserService;
import es.iespuertodelacruz.nla.user.domain.port.secondary.IUserRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class UserService implements IUserService {
    @Autowired
    IUserRepository repository;
    @Override
    public User add(String name, int stock, float price) {
        User aux = new User(name, stock, price);
        return repository.save(aux);
    }

    @Override
    public User findById(Integer id) {
        return repository.findById(id);
    }

    @Override
    public List<User> findAll() {
        return repository.findAll();
    }
}
