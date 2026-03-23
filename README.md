# AlmacenGT Theme

Tema WordPress marketplace profesional para AlmacenGT.

## Configuración del Entorno de Desarrollo

### 1. Archivos de Configuración

Los archivos de configuración ya están incluidos en el repositorio:

- `.vscode/settings.json` - Configuración de VS Code e Intelephense
- `wordpress-stubs.php` - Definiciones de funciones de WordPress para evitar errores de linting
- `composer.json` - Dependencias de desarrollo (opcional)

### 2. Instalación Opcional de Composer

Si tienes Composer instalado, puedes ejecutar:

```bash
composer install
```

Esto instalará stubs adicionales de WordPress y WooCommerce.

### 3. Reiniciar VS Code

Reinicia VS Code para que Intelephense cargue las configuraciones y stubs correctamente.

## Estructura del Tema

- `header.php` - Cabecera del sitio con navegación
- `footer.php` - Pie de página
- `functions.php` - Funciones del tema
- `style.css` - Estilos principales
- `woocommerce.css` - Estilos específicos de WooCommerce
- `js/carousel.js` - JavaScript para carruseles y navegación móvil
- `js/live-search.js` - Búsqueda en vivo

## Funcionalidades

- **Navegación móvil colapsable**: El menú de categorías se puede contraer/expandir en móvil
- **Header compacto**: Ocupa menos del 25% de la pantalla en móvil
- **Búsqueda en vivo**: Sugerencias de productos en tiempo real
- **Carrusel de hero**: Slider automático con controles táctiles

## Desarrollo

Para contribuir al desarrollo:

1. Los archivos de configuración ya están incluidos
2. Reinicia tu editor de código
3. Los errores de "función indefinida" deberían desaparecer

## Notas Técnicas

- Compatible con WordPress 5.0+
- Requiere WooCommerce 5.0+
- Utiliza CSS Grid y Flexbox para layouts responsivos
- JavaScript vanilla (sin jQuery para funcionalidades nuevas)