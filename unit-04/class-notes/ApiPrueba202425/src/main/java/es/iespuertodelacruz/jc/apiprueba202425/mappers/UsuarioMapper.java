package es.iespuertodelacruz.jc.apiprueba202425.mappers;

import java.util.List;

import org.mapstruct.Mapper;
import org.mapstruct.Mapping;
import org.mapstruct.factory.Mappers;

import es.iespuertodelacruz.jc.apiprueba202425.dto.UsuarioDTO;
import es.iespuertodelacruz.jc.apiprueba202425.entities.Usuario;

@Mapper
public interface UsuarioMapper {

    UsuarioMapper INSTANCE = Mappers.getMapper(UsuarioMapper.class);

    
    @Mapping(target = "fechaCreacion", expression = "java(usuario.getFechaCreacion() != null ? new java.util.Date(usuario.getFechaCreacion()) : null)")
    UsuarioDTO toDTO(Usuario usuario);

 
    @Mapping(target = "fechaCreacion", expression = "java(usuarioDTO.getFechaCreacion() != null ? usuarioDTO.getFechaCreacion().getTime() : null)")
    Usuario toEntity(UsuarioDTO usuarioDTO);

  
    List<UsuarioDTO> toDTOList(List<Usuario> usuarios);

   
    List<Usuario> toEntityList(List<UsuarioDTO> usuarioDTOs);
}