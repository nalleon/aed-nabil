package es.iespuertodelacruz.nla.institutov2.controller.interfaces;
import io.swagger.v3.oas.annotations.parameters.RequestBody;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.PathVariable;

import java.util.List;
public interface IController<T, E> {
    public ResponseEntity<?> add(@RequestBody T t);

    public ResponseEntity<?> update(@PathVariable E id, @RequestBody T t);

    public ResponseEntity<List<T>> getAll();

    public ResponseEntity<T> getById(E id);

    public ResponseEntity<?> delete(E id);
}
