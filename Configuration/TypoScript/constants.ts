# Plugin configuration
# ====================

plugin {
  tx_t3vcore {
    settings {
      # ...
    }

    persistence {
      # cat=plugin/tx_t3vcore/persistence; type=int+; label=The PID of the storage
      # storagePid = 0
    }

    view {
      # cat=plugin/tx_t3vcore/view; type=string; label=Path to layouts
      layoutRootPath = EXT:t3v_core/Resources/Private/Layouts/

      # cat=plugin/tx_t3vcore/view; type=string; label=Path to templates
      templateRootPath = EXT:t3v_core/Resources/Private/Templates/

      # cat=plugin/tx_t3vcore/view; type=string; label=Path to template partials
      partialRootPath = EXT:t3v_core/Resources/Private/Partials/
    }
  }
}