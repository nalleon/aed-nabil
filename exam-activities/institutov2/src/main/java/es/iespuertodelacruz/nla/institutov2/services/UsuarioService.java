package es.iespuertodelacruz.nla.institutov2.services;

import es.iespuertodelacruz.nla.institutov2.entities.Usuario;
import es.iespuertodelacruz.nla.institutov2.repository.IUsuarioRepository;
import es.iespuertodelacruz.nla.institutov2.services.interfaces.IServiceGeneric;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;
/**
 * @author Nabil Leon Alvarez <@nalleon>
 */
@Service
public class UsuarioService implements IServiceGeneric<Usuario, Integer> {
    @Autowired
    IUsuarioRepository repository;
    @Override
    public List<Usuario> findAll() {
        return repository.findAll();
    }

    @Override
    public Usuario findById(Integer id) {
        return repository.findById(id).orElse(null);

    }

    public Usuario findByNombre(String nombre) {
        return repository.findUsuarioByNombre(nombre).orElse(null);

    }

    public Usuario findByCorreo(String correo) {
        return repository.findUsuarioByCorreo(correo).orElse(null);

    }

    @Override
    @Transactional
    public Usuario save(Usuario obj) {
        if (obj == null){
            return null;
        }
        Usuario dbItem = repository.findById(obj.getId()).orElse(null);

        if (dbItem != null){
            return null;
        }

        try {
            return repository.save(obj);
        } catch (RuntimeException e){
            throw new RuntimeException("Invalid data");
        }
    }

    @Override
    @Transactional
    public boolean delete(Integer id) {
        try {
            int quantity = repository.deleteUsuarioById(id);
            return quantity > 0;
        } catch (RuntimeException e){
            throw new RuntimeException();
        }
    }

    @Override
    @Transactional
    public boolean update(Usuario obj) {
        if(obj!=null) {
            Usuario dbItem = repository.findById(obj.getId()).orElse(null);
            if(dbItem != null){
                try {
                    dbItem.setNombre(obj.getNombre());
                    dbItem.setPassword(obj.getPassword());
                    dbItem.setVerificado(obj.getVerificado());
                    dbItem.setRol(obj.getRol());
                    return true;
                } catch (RuntimeException e){
                    throw new RuntimeException("Invalid data");
                }
            }
        }
        return false;

    }
}
