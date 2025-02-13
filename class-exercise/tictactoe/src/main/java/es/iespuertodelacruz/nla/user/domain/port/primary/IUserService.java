package es.iespuertodelacruz.nla.user.domain.port.primary;

import es.iespuertodelacruz.nla.user.domain.User;

import java.util.List;

public interface IUserService {
    User add(String name, int stock, float price);
    User findById(Integer id);

    List<User> findAll();
}
